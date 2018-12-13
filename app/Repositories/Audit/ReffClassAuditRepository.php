<?php

namespace App\Repositories\Audit;

use App\Models\Audit\ReffClassAudit;
use InfyOm\Generator\Common\BaseRepository;

class ReffClassAuditRepository extends BaseRepository
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
        return ReffClassAudit::class;
    }
}
