<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia};

class WorkerObservation extends Model implements HasMedia
{
    use InteractsWithMedia, LogsActivity;

    protected $table = "worker_observation";

	protected $primaryKey = "id";

    protected $fillable = [
    	'company_id',
        'worker_covid_test_id',
        'name',
        'gender',
        'dob',
        'phone_number',
        'position',
        'position_in_group',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'bio_id',
        'id_number',
        'nssf_number',
        'workpermit_id',
        'nationality',
        'book_number',
        'latin_name',
        'status',
        'level_1',
        'level_2',
        'level_3',
        'level_status',
        'doctor_id',
        'training_at',
        'approved_by',
        'approved_at',
        'void_by',
        'void_at',
        'updated_by',
        'worker_excel_id',
    ];

    protected static $logAttributes = [
        'company_id',
        'worker_covid_test_id',
        'name',
        'gender',
        'dob',
        'phone_number',
        'position',
        'position_in_group',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'bio_id',
        'id_number',
        'nssf_number',
        'workpermit_id',
        'nationality',
        'book_number',
        'latin_name',
        'status',
        'level_1',
        'level_2',
        'level_3',
        'level_status',
        'doctor_id',
        'training_at',
        'approved_by',
        'approved_at',
        'void_by',
        'void_at',
        'updated_by',
        'worker_excel_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function nationalities()
    {
        return $this->belongsTo('App\Models\Bio\Nationality', 'nationality');
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

    public function verify()
    {
        return $this->hasMany('App\Models\Covid\WorkerObservationVerify', 'request_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Covid\WorkerObservationVoid', 'request_id');
    }

    public function apprvoedBy(){
        return $this->belongsTo('App\Models\User\User', 'approved_by');
    }

    public function voidBy(){
        return $this->belongsTo('App\Models\User\User', 'void_by');
    }

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

    public function covid_tool(){
        return $this->morphToMany("App\Models\Covid\CovidTool", 'covidtoolables');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} WorkerObservation";
    }

}
