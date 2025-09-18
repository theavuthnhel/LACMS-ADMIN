<?php

namespace App\Models\Physical;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Plan extends Model
{
	use LogsActivity, SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $table = "plan";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'date',
        'day',
        'shift',
        'start_time',
        'end_time',
        'amount',
        'system_date',
        'is_full',
        'created_by',
        'updated_by',
    ];

    protected static $logAttributes = [
    	'date',
        'day',
        'shift',
        'start_time',
        'end_time',
        'amount',
        'system_date',
        'is_full',
        'created_by',
        'updated_by',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function walkInQueue()
    {
        return $this->hasMany('App\Models\Physical\WalkInQueue', 'plan_id')->withTrashed();
    }

    public function walkInQueueWithoutTrashed()
    {
        return $this->hasMany('App\Models\Physical\WalkInQueue', 'plan_id');
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Plan";
    }

    // public function getStatusTranslateAttribute()
    // {
    //     switch ($this->status) {
    //         case 0:
    //             return __('bio::bio.pending');
    //         case 1:
    //             return __('bio::bio.approved');
    //         case 2:
    //             return __('bio::bio.declined');
    //         case 3:
    //             return __('bio::bio.void');
    //         case 4:
    //             return __('bio::bio.preparing');
    //     }
    // }
}
