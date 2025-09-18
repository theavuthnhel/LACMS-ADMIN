<?php

namespace App\Models\Physical;

use Illuminate\Database\Eloquent\Model;

class PhysicalDecline extends Model
{
	protected $table = "physical_decline";

    protected $fillable = [
        'physical_id',
    	'reason',
        'created_by'
    ];

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }
}
