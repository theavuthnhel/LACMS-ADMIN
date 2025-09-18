<?php

namespace App\Models\Apprenticeship;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;

class Apprenticeship extends Model implements HasMedia
{
    use InteractsWithMedia, LogsActivity;

    protected $table = "apprenticeship";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'code',
        'company_id',
        'for_year',
        'from_date',
        'to_date',
        'testing_location',
        'testing_date',
        'total_staff',
        'total_staff_female',
        'total_staff_male',
        'status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_status',
        'approved_at',
        'approved_by',
        'created_by',
        'updated_by',
        'control_province',
        'payment_status',
        'payment_date',
        'declined_at',
        'edit_status',
        'submitted_at',
        'total_allow_amount',
        'type',
        'certificate_code',
        'certificate_book_code',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'payment_date_origin',
    ];

    protected static $logAttributes = [
        'code',
        'company_id',
        'for_year',
        'from_date',
        'to_date',
        'testing_location',
        'testing_date',
        'total_staff',
        'total_staff_female',
        'total_staff_male',
        'status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_status',
        'approved_at',
        'approved_by',
        'created_by',
        'updated_by',
        'control_province',
        'payment_status',
        'payment_date',
        'declined_at',
        'edit_status',
        'submitted_at',
        'total_allow_amount',
        'type',
        'certificate_code',
        'certificate_book_code',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'payment_date_origin',
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

    public function apprenticeship_detail(){
        return $this->hasMany('App\Models\Apprenticeship\ApprenticeshipDetail', 'apprenticeship_id');
    }

    public function apprenticeship_training_program(){
        return $this->hasMany('App\Models\Apprenticeship\ApprenticeshipTrainingProgram', 'apprenticeship_id');
    }

    public function apprenticeship_training_teacher(){
        return $this->hasMany('App\Models\Apprenticeship\ApprenticeshipTrainingTeacher', 'apprenticeship_id');
    }

    public function request_branch(){
        return $this->belongsTo('App\Models\User\Branch', 'control_province');
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Apprenticeship\ApprenticeshipVerify', 'apprenticeship_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Apprenticeship\ApprenticeshipDecline', 'apprenticeship_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Apprenticeship\ApprenticeshipVoid', 'apprenticeship_id');
    }

    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }

    public function approvedBy(){
        return $this->belongsTo('App\Models\User\User', 'approved_by');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

}
