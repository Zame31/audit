<?php

namespace App\Repositories\Audit;

use App\Models\Audit\ReffActivity;
use InfyOm\Generator\Common\BaseRepository;

class ReffActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ReffActivity::class;
    }
}
