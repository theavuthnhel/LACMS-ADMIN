<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Tracking extends Model
{
    use LogsActivity, SoftDeletes;
    protected $dates = ['deleted_at'];

	protected $table = "tracking";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'tracking_number',
        'created_by',
    ];

    /*protected static $logAttributes = [
    	'tracking_number',
        'created_by',
    ];*/
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['tracking_number', 'created_by']);
    }

    public function trackingables()
    {
        return $this->hasMany(Trackingables::class, 'tracking_id');
    }

    public function registration()
    {
        return $this->morphedByMany('App\Models\Registration', 'trackingables');
    }

    public function request_ir()
    {
        return $this->morphedByMany('App\Models\RequestIR', 'trackingables');
    }

    public function request_ot()
    {
        return $this->morphedByMany('App\Models\RequestOT', 'trackingables');
    }

    public function request_book()
    {
        return $this->morphedByMany('App\Models\RequestBookPayroll', 'trackingables');
    }

    public function physical()
    {
        return $this->morphedByMany('App\Models\Physical', 'trackingables');
    }

    public function physical_spot()
    {
        return $this->morphedByMany('App\Models\PhysicalSpot', 'trackingables');
    }

    public function vote()
    {
        return $this->morphedByMany('App\Models\Vote', 'trackingables');
    }

    public function bio()
    {
        return $this->morphedByMany('App\Models\Bio', 'trackingables');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Tracking";
    }


}
