<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = "village";
    protected $fillable = [];

    public function province()
    {
        return $this->belongsTo('App\Models\Bio\Province', 'province_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\Bio\District', 'district_id');
    }

    public function commune()
    {
        return $this->belongsTo('App\Models\Bio\Commune', 'commune_id', 'com_id');
    }

    public function getFullNameAttribute()
    {
        return $this->commune['com_khname'] . ' | ' . $this->vil_khname;
    }
}
