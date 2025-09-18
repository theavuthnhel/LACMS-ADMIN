<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserDecline extends Model
{
    protected $table = "user_decline";

    protected $fillable = [
        'user_id',
    	'reason',
        'created_by'
    ];

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }
}
