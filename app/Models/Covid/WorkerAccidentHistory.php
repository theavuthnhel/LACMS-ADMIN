<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia} ;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;

class WorkerAccidentHistory extends Model implements HasMedia
{
	use LogsActivity, InteractsWithMedia, SoftDeletes;

	protected $table = "worker_accident_history";

	protected $primaryKey = "id";

	protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
        'worker_excel_id',
        'position',
        'seniority',
        'safety_training',
        'accident_date',
        'accident_place',
        'accident_type',
        'accident_organ',
        'accident_level',
        'accident_descripe',
        'created_by',
        'updated_by',
        'status',
        'submitted_at',
    ];

    protected static $logAttributes = [
		'company_id',
        'worker_excel_id',
        'position',
        'seniority',
        'safety_training',
        'accident_date',
        'accident_place',
        'accident_type',
        'accident_organ',
        'accident_level',
        'accident_descripe',
        'created_by',
        'updated_by',
        'status',
        'submitted_at',
    ];

    protected static $accident_type = [
        '1' => 'ស្រាល',
    ];

    protected static $accident_organ = [
        '1' => 'ក្បាល',
        '2' => 'ក',
        '3' => 'ដងខ្លួន',
        '4' => 'ដៃ',
        '5' => 'ជើង',
    ];

    protected static $accident_level = [
        '1' => 'ស្រាល',
        '2' => 'ធ្ងន់',
        '3' => 'ស្លាប់',
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

    public static function getAccidentOrgan(){
        return self::$accident_organ;
    }

    public static function getAccidentLevel(){
        return self::$accident_level;
    }

    public static function getAccidentType(){
        return self::$accident_type;
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} WorkerAccidentHistory";
    }
}
