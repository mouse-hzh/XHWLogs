<?php
namespace Mouse\XHWLogs\Facades;
use Illuminate\Support\Facades\Facade;

class XHWLogs extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'xhwLogs';
    }
}
