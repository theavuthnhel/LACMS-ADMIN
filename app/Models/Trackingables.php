<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trackingables extends Model
{
    protected $fillable = [
        'tracking_id',
        'trackingables_type',
        'trackingables_id',
        'created_at',
        'updated_at'
    ];

    public function tracking()
    {
        return $this->belongsTo('App\Tracking', 'tracking_id');
    }

    public function registration()
    {
        return $this->belongsTo('App\Models\Registration\Registration', 'trackingables_id');
    }

    public function bio()
    {
        return $this->morphedByMany('App\Models\Bio\Bio', 'trackingables');
    }

}
