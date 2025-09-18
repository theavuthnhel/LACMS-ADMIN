<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = "application_level";
	protected $primaryKey = "id";
    protected $fillable = [
    	'name_en',
    	'name_kh',
    	'role_id',
    	'right',
    ];

    public function role()
    {
    	return $this->belongsTo(Role::class, 'role_id');
    }

}
