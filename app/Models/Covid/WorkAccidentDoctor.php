<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia};

class WorkAccidentDoctor extends Model implements HasMedia
{
	use LogsActivity, InteractsWithMedia, SoftDeletes;


	protected $table = "work_accident_doctor";

	protected $primaryKey = "id";

	protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
        'work_accident_id',
        'worker_excel_id',
        'certificate',
        'under_training_of',
        'approved_certificate',
        'station',
        'created_by',
        'updated_by',
        'status',
        'submitted_at',
    ];

    protected static $logAttributes = [
    	'company_id',
        'work_accident_id',
        'worker_excel_id',
        'certificate',
        'under_training_of',
        'approved_certificate',
        'station',
        'created_by',
        'updated_by',
        'status',
        'submitted_at',
    ];

    protected static $certificate_type = [
        '1' => 'វេជ្ជបណ្ឌិត',
        '2' => 'គិលានុបដ្ឋាក',
        '3' => 'ឆ្មប',
    ];

    protected static $under_training_of_type = [
        '1' => 'នាយកដ្ឋានពេទ្យការងារ',
        '2' => 'ស្ថាប័នឯកជន',
        '3' => 'ផ្ទៃក្នុងរោងចក្រ សហគ្រាស',
        '4' => 'អង្គការ ឬដៃគូអភិវឌ្ឍន៍',
        '5' => 'គ្មាន',
    ];

    protected static $station_type = [
        '1' => 'គ្រូពេទ្យ',
        '2' => 'បុគ្គលិកប្រចាំបន្ទប់រុំរបួស',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public static function getCertificate(){
        return self::$certificate_type;
    }

    public static function getCertificateByID($id){
        return self::$certificate_type[$id];
    }

    public static function getUnderTrainingOf(){
        return self::$under_training_of_type;
    }

    public static function getUnderTrainingOfByID($id){
        return self::$under_training_of_type[$id];
    }

    public static function getStation(){
        return self::$station_type;
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function worker_excel()
    {
        return $this->belongsTo('App\Models\Company\WorkerExcel', 'worker_excel_id');
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} WorkAccidentDoctor";
    }
}
