<?php

namespace App\Models;

use Eloquent as Model;

class ActiveSmtp extends Model
{

    public $table = 'active_smtp';

    public $fillable = [
        'smtp_setting_id',
    ];
}
