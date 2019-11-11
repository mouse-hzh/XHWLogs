<?php

namespace Mouse\XHWLogs\Models;

use Illuminate\Database\Eloquent\Model;

class OperationLog extends Model
{
    protected $table = 'operation_logs';

    protected $fillable = [
        'operation_description_id',
        'operate_user_id',
        'request_uri',
        'controller',
        'function',
        'request_params',
        'request_extension_params',
        'response_data',
    ];
}
