<?php

namespace App\Models\Vote;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vote extends Model implements HasMedia
{
	use InteractsWithMedia, LogsActivity, SoftDeletes;

	protected $table = "vote";

	protected $primaryKey = "id";

	protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
    	'emp_total',
    	'emp_female',
    	'terms',
    	'start_date',
    	'end_date',
    	'start_time',
    	'end_time',
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
        'control_province',
        'code',
        'edit_status',
    	'created_by',
    	'updated_by',
        'member',
        'approved_id',
        'provincial_control',
        'secretary_name',
        'request_vote_type',
        'member_female',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'payment_date_origin',
    ];

    protected static $logAttributes = [
    	'company_id',
    	'emp_male',
    	'emp_female',
    	'terms',
    	'start_date',
    	'end_date',
    	'start_time',
    	'end_time',
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
        'control_province',
        'code',
        'edit_status',
    	'created_by',
    	'updated_by',
        'member',
        'approved_id',
        'provincial_control',
        'secretary_name',
        'request_vote_type',
        'member_female',
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


    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }
    public function verify()
    {
        return $this->hasMany('App\Models\Vote\VoteVerify', 'vote_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Vote\VoteDecline', 'vote_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Vote\VoteVoid', 'vote_id');
    }

    public function vote_items(){
        return $this->hasMany('App\Models\Vote\VoteDetail', 'vote_id');
    }

    public function branching()
    {
        return $this->hasOne('App\Models\User\Branch', 'id', 'control_province');
    }




}
