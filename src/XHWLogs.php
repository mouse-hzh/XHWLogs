<?php
namespace Mouse\XHWLogs;

use Illuminate\Config\Repository;
use Mouse\XHWLogs\Models\OperationDescription;
use Mouse\XHWLogs\Models\OperationLog;
use Route;

class XHWLogs
{

    /**
     * @var Repository
     */
    protected $config;

    protected $operationLogId;

    /**
     * Packagetest constructor.
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * @param $request
     * @param int $userId
     * @return mixed
     * @throws \Exception
     */
    public function recordRequestParameters($request, $userId = 0)
    {
        if (!$userId) {
            throw new \Exception("Please fill the middleware XHWLogs's recordRequestParameters function's second parameter");
        }

        $configArr     = $this->config->get('xhwLogs');
        $requestMethod = $request->getMethod();
        $requestUri    = $request->getRequestUri(); // if the uri is homepage, return

        if (!$configArr['enable'] || ($requestMethod == 'GET' && $configArr['record_get_method']) || $requestUri == '/') {
            return null;
        }

        $actionName                 = $request->route()->getActionName();
        $controllerAndFunctionArray = explode('@', substr($actionName, strrpos($actionName, "\\") + 1));
        $controllerName             = $controllerAndFunctionArray[0] ?? '';
        $functionName               = $controllerAndFunctionArray[1] ?? '';

        // white list (no need redord)
        $whiteList = WhiteList::where('controller', $controllerName)->where('function', $functionName)->first();
        if ($whiteList) {
            return null;
        }

        $operationDescription = OperationDescription::query()->where('controller', $controllerName)->where('function', $functionName)->first();

        $requestParameters          = json_encode($request->all(), JSON_UNESCAPED_UNICODE);
        $requestExtensionParameters = json_encode($request->route()->parameters(), JSON_UNESCAPED_UNICODE);

        $operationLog = OperationLog::create([
            'operation_description_id' => $operationDescription ? $operationDescription->id : 0,
            'operate_user_id'          => $userId,
            'request_uri'              => $requestUri,
            'controller'               => $controllerName,
            'function'                 => $functionName,
            'request_params'           => $requestParameters,
            'request_extension_params' => $requestExtensionParameters,
            'response_data'            => '',
        ]);

        return $operationLog;

    }

    public function recordResponseParameters($operationLog, $response)
    {
        $configArr = $this->config->get('xhwLogs');
        // need record response
        if ($configArr['record_response']) {
            $response = $response->content();

            if ($operationLog instanceof OperationLog) {

                if (is_array($response) || is_object($response)) {
                    $operationLog->response_data = json_encode($response, JSON_UNESCAPED_UNICODE);
                    $operationLog->save();
                } else {
                    $operationLog->response_data = (string) $response;
                    $operationLog->save();
                }
            }
        }
    }
}
