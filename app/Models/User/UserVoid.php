<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserVoid extends Model
{
    protected $table = "user_void";

    protected $fillable = [
        'user_id',
    	'reason',
        'created_by'
    ];

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }
}
