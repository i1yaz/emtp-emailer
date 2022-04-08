<?php

namespace App\Repositories;

use App\Models\Email;
use App\Repositories\BaseRepository;

/**
 * Class EmailRepository
 * @package App\Repositories
 * @version April 8, 2022, 5:19 pm UTC
*/

class EmailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'from',
        'to',
        'subject',
        'body',
        'attachment'
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
        return Email::class;
    }
}
