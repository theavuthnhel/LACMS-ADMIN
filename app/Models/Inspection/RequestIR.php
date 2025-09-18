<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;


class RequestIR extends Model implements HasMedia
{
    use InteractsWithMedia, LogsActivity, SoftDeletes;

	protected $table = "request_ir";

	protected $primaryKey = "id";

	protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
    	'request_type',
    	'sign_date',
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
        'branch_id',
        'code',
        'edit_status',
    	'created_by',
    	'updated_by',
        'letter_no',
        'letter_date',
        'ir_type',
        'timein',
        'timeout',
        'timein1',
        'timeout1',
        'dayoff',
        'time_shift_type',
        'other_type',
        'dayoff_type',
        'timein2',
        'timein2_1',
        'timein2_2',
        'timein2_3',
        'timeout2',
        'timeout2_1',
        'timeout2_2',
        'timeout2_3',
        'timein3',
        'timein3_1',
        'timein3_2',
        'timeout3',
        'timeout3_1',
        'timeout3_2',
        'working_duration',
        'provincial_control',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'approved_id',
        'payment_date_origin',
        'print_status',
        'print_date',
        'print_by',
        'updated_by_company_at',
    ];

    protected static $logAttributes = [
        'company_id',
        'request_type',
        'sign_date',
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
        'branch_id',
        'code',
        'edit_status',
        'created_by',
        'updated_by',
        'letter_no',
        'letter_date',
        'ir_type',
        'timein',
        'timeout',
        'timein1',
        'timeout1',
        'dayoff',
        'time_shift_type',
        'other_type',
        'dayoff_type',
        'timein2',
        'timein2_1',
        'timein2_2',
        'timein2_3',
        'timeout2',
        'timeout2_1',
        'timeout2_2',
        'timeout2_3',
        'timein3',
        'timein3_1',
        'timein3_2',
        'timeout3',
        'timeout3_1',
        'timeout3_2',
        'working_duration',
        'provincial_control',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'approved_id',
        'payment_date_origin',
        'print_status',
        'print_date',
        'print_by',
        'updated_by_company_at',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'approved_by');
    }

    public function declinedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'declined_by');
    }

    public function voideBy()
    {
        return $this->belongsTo('App\Models\User\User', 'void_by');
    }

    public function printedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'print_by');
    }
    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

}
