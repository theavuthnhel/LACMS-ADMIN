<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia};

class WorkerIllness extends Model implements HasMedia
{
	use InteractsWithMedia, LogsActivity, SoftDeletes;

	protected $table = "worker_illness";

	protected $primaryKey = "id";

	protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
        'worker_excel_id',
        'illness_id',
        'start_admit_date',
        'stop_admit_date',
        'doctor_id',
        'created_by',
        'updated_by',
        'status',
        'submitted_at',
    ];

    protected static $logAttributes = [
    	'company_id',
        'worker_excel_id',
        'illness_id',
        'start_admit_date',
        'stop_admit_date',
        'doctor_id',
        'created_by',
        'updated_by',
        'status',
        'submitted_at',
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

    public function illness()
    {
        return $this->belongsTo('App\Models\Covid\WorkerIllnessItem', 'illness_id');
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function scopeAgedBetween($query, $start, $end = null)
    {
        if (is_null($end)) {
            $end = $start;
        }

        $start = Carbon::today()->subYears($start);
        $end = Carbon::today()->subYears($end); // plus 1 year minus a day

        $filter = function ($q) use ($start, $end) {
            $q->whereBetween(DB::raw("STR_TO_DATE(dob, '%d-%m-%Y')"), [$end, $start]);
        };

        return $query->whereHas('worker_excel', $filter);
    }

    public function scopeAgedOver($query, $start)
    {
        $start = Carbon::today()->subYears($start);

        $filter = function ($q) use ($start) {
            $q->where(DB::raw("STR_TO_DATE(dob, '%d-%m-%Y')"), '<=', $start);
        };

        return $query->whereHas('worker_excel', $filter);
    }

    public function scopeGender($query, $gender)
    {
        $filter = function ($q) use ($gender) {
            $q->where('gender', $gender);
        };

        return $query->whereHas('worker_excel', $filter);
    }

    public function scopeCategories($query, $categories)
    {
        $filter = function ($q) use ($categories) {
            $q->where('categories_id', $categories);
        };

        return $query->whereHas('illness', $filter);
    }

    public function scopeDuration($query, $month, $year)
    {
        return $query->whereMonth('start_admit_date', $month)->whereYear('start_admit_date', $year);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} WorkerIllness";
    }
}
