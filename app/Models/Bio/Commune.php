<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = "commune";
    protected $fillable = [
        'com_khname'
    ];

    public function province()
    {
        return $this->belongsTo('App\Models\Bio\Province', 'province_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\Bio\District', 'district_id', 'dis_id');
    }

    public function getFullNameAttribute()
    {
        return $this->district['dis_khname'] . ' | ' . $this->com_khname;
    }
}
