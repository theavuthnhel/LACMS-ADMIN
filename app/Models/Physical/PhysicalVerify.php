<?php

namespace App\Models\Physical;

use Illuminate\Database\Eloquent\Model;

class PhysicalVerify extends Model
{
    protected $table = "physical_verify";


    protected $fillable = [
        'physical_id',
    	'comment',
    	'level',
        'created_by',
    ];

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }
}
