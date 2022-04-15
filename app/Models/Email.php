<?php

namespace App\Models;

use Eloquent as Model;



/**
 * Class Email
 * @package App\Models
 * @version April 8, 2022, 5:19 pm UTC
 *
 * @property string $from
 * @property string $to
 * @property string $subject
 * @property string $body
 * @property string $attachment
 */
class Email extends Model
{


    public $table = 'emails';




    public $fillable = [
        'from',
        'to',
        'subject',
        'body',
        'attachment'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'subject' => 'string',
        'attachment' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'from' => ['required'],
        'to' => ['required'],
        'subject' => ['required'],
        // 'body' => ['required'],
    ];
}
