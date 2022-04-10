<?php

namespace App\Repositories;

use App\Models\SmtpSetting;
use App\Repositories\BaseRepository;

/**
 * Class SmtpSettingRepository
 * @package App\Repositories
 * @version April 8, 2022, 12:32 pm UTC
 */

class SmtpSettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'host',
        'port',
        'username',
        'password',
        'encryption',
        'from_address',
        'from_name'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SmtpSetting::class;
    }
}
