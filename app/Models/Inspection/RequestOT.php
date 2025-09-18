<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;


class RequestOT extends Model implements HasMedia
{
    use InteractsWithMedia, LogsActivity, SoftDeletes;

    protected $table = "request_ot";

    protected $primaryKey = "id";

    protected $dates = ['deleted_at'];


    protected static $logOnlyDirty = true;

    protected $fillable = [
        'company_id',
        'request_type',
        'start_date',
        'end_date',
        'status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_6',
        'level_7',
        'level_status',
        'approved_by',
        'approved_at',
        'declined_by',
        'declined_at',
        'void_by',
        'void_at',
        'payment_status',
        'payment_date',
        'branch_id',
        'code',
        'edit_status',
        'created_by',
        'updated_by',
        'letter_no',
        'letter_date',
        'provincial_control',
        'request_app_type',
        'request_reasons',
        'request_worker_total',
        'request_worker_female',
        'normal_hour',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'approved_id',
        'payment_date_origin',
        'total_staff_on_request',
        'total_staff_female_on_request',
        'is_night',
        'timein',
        'timeout',
        'record_type',
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'company_id',
                'request_type',
                'start_date',
                'end_date',
                'status',
                'level_1',
                'level_2',
                'level_3',
                'level_4',
                'level_5',
                'level_6',
                'level_7',
                'level_status',
                'approved_by',
                'approved_at',
                'declined_by',
                'declined_at',
                'void_by',
                'void_at',
                'payment_status',
                'payment_date',
                'branch_id',
                'code',
                'edit_status',
                'created_by',
                'updated_by',
                'letter_no',
                'letter_date',
                'provincial_control',
                'request_app_type',
                'request_reasons',
                'request_worker_total',
                'request_worker_female',
                'normal_hour',
                'request_name',
                'request_position',
                'request_phone',
                'request_gender',
                'approved_id',
                'payment_date_origin',
                'total_staff_on_request',
                'total_staff_female_on_request',
                'is_night',
                'timein',
                'timeout',
                'record_type',
            ]);
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
        return $this->morphToMany('App\Tracking', 'trackingables');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function scopeCompany($query)
    {
        return $query->where('company_id', \Auth::user()->company->id);
    }

    public function oth_items()
    {
        return $this->hasMany('App\Models\Inspection\OTHDetail', 'request_ot_id');
    }

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

    public function branching()
    {
        return $this->hasOne('App\Models\User\Branch', 'id', 'branch_id');
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Inspection\RequestOTVerify', 'request_ot_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Inspection\RequestOTDecline', 'request_ot_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Inspection\RequestOTVoid', 'request_ot_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'approved_by');
    }

    public function declinedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'declined_by');
    }

    public function voideBy()
    {
        return $this->belongsTo('App\Models\User\User', 'void_by');
    }

}
