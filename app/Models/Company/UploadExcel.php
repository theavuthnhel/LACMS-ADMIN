<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class UploadExcel extends Model implements HasMedia
{
	use InteractsWithMedia, LogsActivity, SoftDeletes;

	protected $table = "upload_excel";

	protected $primaryKey = "id";

    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
        'excel_status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_status',
        'approved_at',
        'approved_by',
        'declined_at',
        'declined_by',
        'is_complete_upload',
        'export_excel_date',
        'export_excel_by',
        'created_by',
        'updated_by',
        'is_upload_excel',
     ];

    protected static $logAttributes = [
    	'company_id',
        'excel_status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_status',
        'approved_at',
        'approved_by',
        'declined_at',
        'declined_by',
        'is_complete_upload',
        'export_excel_date',
        'export_excel_by',
        'created_by',
        'updated_by',
        'is_upload_excel',
    ];


    public function getActivitylogOptions() : LogOptions
    {
      return LogOptions::defaults()
       ->logOnly( [
           'company_id',
           'excel_status',
           'level_1',
           'level_2',
           'level_3',
           'level_4',
           'level_status',
           'approved_at',
           'approved_by',
           'declined_at',
           'declined_by',
           'is_complete_upload',
           'export_excel_date',
           'export_excel_by',
           'created_by',
           'updated_by',
           'is_upload_excel',
       ]);
    }


    public function createdBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function worker_excel()
    {
        return $this->hasMany('App\Models\Company\WorkerExcel', 'request_id');
    }

    public function branchs()
    {
        return $this->hasOne('App\Models\User\Branch', 'id', 'branch_id');
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Company\ImportVerify', 'company_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Company\ImportDecline', 'company_id');
    }

    public function approvedBy(){
        return $this->belongsTo('App\Models\User\User', 'approved_by');
    }

    public function declinedBy(){
        return $this->belongsTo('App\Models\User\User', 'declined_by');
    }

    public function exportedBy(){
        return $this->belongsTo('App\Models\User\User', 'export_excel_by');
    }

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} UploadExcel";
    }
}
