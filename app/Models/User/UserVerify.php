<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserVerify extends Model
{
	protected $table = "user_verify";

    protected $fillable = [
        'user_id',
    	'comment',
    	'level',
        'created_by',
    ];

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }
}
