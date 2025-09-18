<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "district";

    protected $fillable = [
        'dis_khname'
    ];

    public function province()
    {
        return $this->belongsTo('App\Models\Bio\Province', 'province_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return $this->province['pro_khname']  . ' | ' . $this->dis_khname ;
    }
}
