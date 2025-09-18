<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia} ;

class SOP3 extends Model implements HasMedia
{
	use LogsActivity, InteractsWithMedia, SoftDeletes;

	protected $table = "sop_3";

	protected $primaryKey = "id";

	protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
        'question_1',
        'question_2',
        'question_3',
        'question_4',
        'question_5',
        'question_6',
        'question_7',
        'question_8',
        'question_9',
        'question_10',
        'question_11',
        'question_12',
        'question_13',
        'question_14',
        'question_15',
        'question_16',
        'question_17',
        'question_18',
        'question_19',
        'question_20',
        'question_21',
        'question_22',
        'question_23',
        'question_24',
        'question_25',
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
        'question_1',
        'question_2',
        'question_3',
        'question_4',
        'question_5',
        'question_6',
        'question_7',
        'question_8',
        'question_9',
        'question_10',
        'question_11',
        'question_12',
        'question_13',
        'question_14',
        'question_15',
        'question_16',
        'question_17',
        'question_18',
        'question_19',
        'question_20',
        'question_21',
        'question_22',
        'question_23',
        'question_24',
        'question_25',
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
        return $this->hasMany('App\Models\Covid\SOP3Verify', 'request_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Covid\SOP3Decline', 'request_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Covid\SOP3Void', 'request_id');
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
        return "{$eventName} SOP3";
    }
}
