<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Model;



class ReffActivity extends Model
{

    public $table = 'reff_activity';
    public $timestamps = false;


    public $fillable = [
        'id',
        'definition',
        'is_active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'definition' => 'string',
        'is_active' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'definition' => 'required',
        'is_active' => 'required'
    ];
}
