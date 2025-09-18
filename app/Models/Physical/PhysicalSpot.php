<?php

namespace App\Models\Physical;

use App\Models\Tracking;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;

class PhysicalSpot extends Model implements HasMedia
{
	use InteractsWithMedia, LogsActivity;

    protected $table = "physical_spot";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
        'request_amount',
        'request_date',
        'request_time',
        'reason',
        'remark',
        'medical_date',
        'medical_time',
        'code',
        'status',
        'payment_status',
        'payemnt_date',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_status',
        'certificate_code',
        'created_by',
        'updated_by',
        'request_name',
        'request_position',
        'request_gender',
        'request_phone',
        'branch_id',
        'request_amount_foreigner',
        'payment_date_origin',
        'submitted_at',
    ];

    protected static $logAttributes = [
    	'company_id',
        'request_amount',
        'request_date',
        'request_time',
        'reason',
        'remark',
        'medical_date',
        'medical_time',
        'code',
        'status',
        'payment_status',
        'payemnt_date',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_status',
        'certificate_code',
        'created_by',
        'updated_by',
        'request_name',
        'request_position',
        'request_phone',
        'branch_id',
        'request_amount_foreigner',
        'payment_date_origin',
        'submitted_at',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function getStatusTranslateAttribute()
    {
        switch ($this->status) {
            case 0:
                return __('bio::bio.pending');
            case 1:
                return __('bio::bio.approved');
            case 2:
                return __('bio::bio.declined');
            case 3:
                return __('bio::bio.void');
            case 4:
                return __('bio::bio.preparing');
            case 5:
                return __('inspection::inspection.waiting_payment');
            case 6:
                return __('inspection::inspection.feedback_for_document');
        }
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }

    public function tracking()
    {
        return $this->morphToMany(Tracking::class, 'trackingables');
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Physical\PhysicalspotVerify', 'physical_spot_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Physical\PhysicalspotDecline', 'physical_spot_id');
    }

    public function physical()
    {
        return $this->hasMany('App\Models\Physical\Physical', 'physical_spot_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Physical\PhysicalspotVoid', 'physical_spot_id');
    }

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

    public function scopeCompany($query){
        if(\Auth::user()->is_company == 1)
            return $query->where('company_id', \Auth::user()->company->id);
    }

    public function scopeApprove($query){
        return $query->where('status', 1);
    }


    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Physical Spot";
    }
}
