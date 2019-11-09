<?php
namespace Mouse\XHWLogs;

use Illuminate\Support\ServiceProvider;

class XHWLogsServiceProvider extends ServiceProvider
{
    /**
     * 服务提供者加是否延迟加载.
     *
     * @var bool
     */
    protected $defer = false; // 延迟加载服务
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/xhwLogs.php' => config_path('xhwLogs.php'), // publish config file to the laravel config directory
            __DIR__ . '/migrations/' => database_path('migrations/'), // publish migrations file to the laravel migrations directory
            __DIR__ . '/Middleware/' => app_path('Http/Middleware/'), // publish middleware file to the laravel middleware directory
        ]);
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // 单例绑定服务
        $this->app->singleton('xhwLogs', function ($app) {
            return new XHWLogs($app['config']);
        });
    }

}
