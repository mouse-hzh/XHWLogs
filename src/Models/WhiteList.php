<?php

namespace Mouse\XHWLogs\Models;

use Illuminate\Database\Eloquent\Model;

class WhiteList extends Model
{
    protected $table = 'white_lists';

    protected $fillable = [
        'controller',
        'function',
    ];
}
