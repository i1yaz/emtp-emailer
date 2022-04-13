<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



/**
 * Class Contact
 * @package App\Models
 * @version April 13, 2022, 8:50 am UTC
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 */
class Contact extends Model
{
    use HasFactory;


    public $table = 'contacts';




    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'phone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'phone' => 'required'
    ];
}
