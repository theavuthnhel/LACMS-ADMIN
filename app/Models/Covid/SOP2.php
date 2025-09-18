<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia} ;

class SOP2 extends Model implements HasMedia
{
	use LogsActivity, InteractsWithMedia, SoftDeletes;

	protected $table = "sop_2";

	protected $primaryKey = "id";

	protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
        'total_dose',
        'total_dose_female',
        'first_dose',
        'first_dose_female',
        'second_dose',
        'second_dose_female',
        'third_dose',
        'third_dose_female',
        'fourth_dose',
        'fourth_dose_female',
        'total_test',
        'total_test_female',
        'total_positive',
        'total_positive_female',
        'total_contact',
        'total_contact_female',
        'total_rapid_test',
        'total_rapid_test_female',
        'total_pcr_test',
        'total_pcr_test_female',
        'total_isolate',
        'total_isolate_female',
        'total_treatment',
        'total_treatment_female',
        'total_recovery',
        'total_recovery_female',
        'total_die',
        'total_die_female',
        'month',
        'year',
        'created_by',
        'updated_by',
        'status',
        'submitted_at',
        'approved_at',
        'approved_by',
        'level_status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'declined_at',
        'declined_by',
        'void_at',
        'void_by',
    ];

    protected static $logAttributes = [
    	'company_id',
        'total_dose',
        'total_dose_female',
        'first_dose',
        'first_dose_female',
        'second_dose',
        'second_dose_female',
        'third_dose',
        'third_dose_female',
        'fourth_dose',
        'fourth_dose_female',
        'total_test',
        'total_test_female',
        'total_positive',
        'total_positive_female',
        'total_contact',
        'total_contact_female',
        'total_rapid_test',
        'total_rapid_test_female',
        'total_pcr_test',
        'total_pcr_test_female',
        'total_isolate',
        'total_isolate_female',
        'total_treatment',
        'total_treatment_female',
        'total_recovery',
        'total_recovery_female',
        'total_die',
        'total_die_female',
        'month',
        'year',
        'created_by',
        'updated_by',
        'status',
        'submitted_at',
        'approved_at',
        'approved_by',
        'level_status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'declined_at',
        'declined_by',
        'void_at',
        'void_by',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Covid\SOP2Verify', 'request_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Covid\SOP2Decline', 'request_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Covid\SOP2Void', 'request_id');
    }

    public function apprvoedBy(){
        return $this->belongsTo('App\Models\User\User', 'approved_by');
    }

    public function declinedBy(){
        return $this->belongsTo('App\Models\User\User', 'declined_by');
    }

    public function voidBy(){
        return $this->belongsTo('App\Models\User\User', 'void_by');
    }

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} SOP2";
    }
}
