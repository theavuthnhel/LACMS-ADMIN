<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	protected $table = "branch";
	protected $primaryKey = "id";
    protected $fillable = [
    	'name_en',
    	'name_kh',
    	'is_active',
    ];

    // public function line(){
    // 	return $this->hasMany('THY\Company\Entities\Line');
    // }

    // public function company(){
    //     return $this->hasMany('THY\Company\Entities\Company');
    // }
}
