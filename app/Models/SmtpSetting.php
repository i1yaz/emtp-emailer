<?php

namespace App\Models;

use Eloquent as Model;



/**
 * Class SmtpSetting
 * @package App\Models
 * @version April 8, 2022, 12:32 pm UTC
 *
 * @property string $host
 * @property integer $port
 * @property string $username
 * @property string $password
 * @property string $encryption
 * @property string $from_address
 */
class SmtpSetting extends Model
{


    public $table = 'smtp_settings';




    public $fillable = [
        'host',
        'port',
        'username',
        'password',
        'encryption',
        'from_address'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'host' => 'string',
        'port' => 'integer',
        'username' => 'string',
        'password' => 'string',
        'encryption' => 'string',
        'from_address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'host' => ['required'],
        'port' => ['required', 'integer'],
        'username' => ['required'],
        'password' => ['required'],
        'encryption' => ['required'],
        'from_address' => ['required']
    ];
}
