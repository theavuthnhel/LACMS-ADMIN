<?php

namespace App\Models\Physical;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalkInQueue extends Model
{
	use LogsActivity, SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $table = "physical_queue";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'plan_id',
        'queue_number',
        'khmer_name',
        'latin_name',
        'gender',
        'dob',
        'position',
        'company_id',
        'is_completed',
        'created_by',
        'updated_by',
        'nationality',
    ];

    protected static $logAttributes = [
    	'plan_id',
        'queue_number',
        'khmer_name',
        'latin_name',
        'gender',
        'dob',
        'position',
        'company_id',
        'is_completed',
        'created_by',
        'updated_by',
        'nationality',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }


    public function planQueue(){
        return $this->belongsTo('App\Models\Physical\Plan', 'plan_id');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Plan";
    }


}
