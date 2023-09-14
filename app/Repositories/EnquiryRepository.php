<?php

namespace App\Repositories;

use App\Models\Enquiry;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EnquiryRepository
 * @package App\Repositories
 * @version June 28, 2018, 10:10 am UTC
 *
 * @method Enquiry findWithoutFail($id, $columns = ['*'])
 * @method Enquiry find($id, $columns = ['*'])
 * @method Enquiry first($columns = ['*'])
*/
class EnquiryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'father_name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Enquiry::class;
    }
}
