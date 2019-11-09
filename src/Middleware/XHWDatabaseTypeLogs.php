<?php
namespace App\Http\Middleware;

use Closure;
use XHWLogs;

class XHWDatabaseTypeLogs
{
    public function handle($request, Closure $next)
    {
        // TODO add $userId to recordRequestParameters's second parameter
        $operationLog = XHWLogs::recordRequestParameters($request);

        $response = $next($request);

        XHWLogs::recordResponseParameters($operationLog, $response);

        return $response;
    }
}
