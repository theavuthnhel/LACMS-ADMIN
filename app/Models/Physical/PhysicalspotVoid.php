<?php

namespace App\Models\Physical;

use Illuminate\Database\Eloquent\Model;

class PhysicalspotVoid extends Model
{
    protected $table = "physical_spot_void";

    protected $fillable = [
        'physical_spot_id',
    	'reason',
        'created_by'
    ];

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }
}
