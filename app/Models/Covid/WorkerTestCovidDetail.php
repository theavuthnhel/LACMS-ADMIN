<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WorkerTestCovidDetail extends Model implements HasMedia
{
    use InteractsWithMedia, LogsActivity;

    protected $table = "worker_covid_test_detail";

	protected $primaryKey = "id";

    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'bio_id',
        'worker_covid_test_id',
    	'company_id',
        'name',
        'gender',
        'dob',
        'id_number',
        'book_number',
        'phone_number',
        'position',
        'type',
        'emergency_phone',
        'marrital_status',
        'first_testing_date',
        'second_testing_date',
        'testing_covid_date',
        'result_date',
        'reason',
        'spot',
        'communication',
        'start_quarantine_date',
        'end_quarantine_date',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'testing_by',
        'testing_tool',
        'results',
        'status',
        'treatment_status',
        'nssf_number',
        'workpermit_id',
        'nationality',
        'latin_name',
        'imei_code',
        'treatment_date',
        'heal_date',
        'verify_status',
        'level_1',
        'level_2',
        'level_3',
        'level_status',
        'approved_by',
        'approved_at',
        'declined_by',
        'declined_at',
        'exported_by',
        'exported_at',
        'submitted_at',
        'test_type',
        'doctor_id',
        'void_by',
        'void_at',
        'updated_by',

    ];

    protected static $logAttributes = [
        'bio_id',
        'worker_covid_test_id',
        'company_id',
        'name',
        'gender',
        'dob',
        'id_number',
        'book_number',
        'phone_number',
        'position',
        'type',
        'emergency_phone',
        'marrital_status',
        'first_testing_date',
        'second_testing_date',
        'testing_covid_date',
        'result_date',
        'reason',
        'spot',
        'communication',
        'start_quarantine_date',
        'end_quarantine_date',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'testing_by',
        'testing_tool',
        'results',
        'status',
        'treatment_status',
        'nssf_number',
        'workpermit_id',
        'latin_name',
        'nationality',
        'imei_code',
        'treatment_date',
        'heal_date',
        'verify_status',
        'level_1',
        'level_2',
        'level_3',
        'level_status',
        'approved_by',
        'approved_at',
        'declined_by',
        'declined_at',
        'exported_by',
        'exported_at',
        'submitted_at',
        'doctor_id',
        'test_type',
        'void_by',
        'void_at',
        'updated_by',

    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function master(){
        return $this->belongsTo('App\Models\Covid\WorkerTestCovid', 'worker_covid_test_id');
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function nationalities()
    {
        return $this->belongsTo('App\Models\Bio\Nationality', 'nationality');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\Physical\Doctor', 'doctor_id');
    }

    public function workerObservation(){
        return $this->belongsTo('App\Models\Covid\WorkerObservation', 'testing_by');
    }

    public function covidTool(){
        return $this->belongsTo('App\Models\Covid\CovidTool', 'testing_tool');
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Covid\WorkerCovidTestDetailVerify', 'request_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Covid\WorkerCovidTestDetailDeclined', 'request_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Covid\WorkerCovidTestDetailVoid', 'request_id');
    }

    public function approvedBy(){
        return $this->belongsTo('App\Models\User\User', 'approved_by');
    }

    public function declinedBy(){
        return $this->belongsTo('App\Models\User\User', 'declined_by');
    }

    public function voidBy(){
        return $this->belongsTo('App\Models\User\User', 'void_by');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} WorkerTestCovidDetail";
    }
}
