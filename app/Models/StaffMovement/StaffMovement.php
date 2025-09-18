<?php

namespace App\Models\StaffMovement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class StaffMovement extends Model implements HasMedia
{
    use LogsActivity, SoftDeletes, InteractsWithMedia;

	protected $dates = ['deleted_at'];

	protected $table = "staff_movement";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
        'type',
        'code',
        'status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_status',
        'approved_at',
        'approved_by',
        'created_by',
        'updated_by',
        'control_province',
        'payment_status',
        'payment_date',
        'declined_at',
        'edit_status',
        'submitted_at',
        'certificate_code',
        'certificate_in_code',
        'certificate_out_code',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'payment_date_origin',
        'is_unout_request',
        'record_type',
    ];



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'company_id',
                'type',
                'code',
                'status',
                'level_1',
                'level_2',
                'level_3',
                'level_4',
                'level_5',
                'level_status',
                'approved_at',
                'approved_by',
                'created_by',
                'updated_by',
                'control_province',
                'payment_status',
                'payment_date',
                'declined_at',
                'edit_status',
                'submitted_at',
                'certificate_code',
                'certificate_in_code',
                'certificate_out_code',
                'request_name',
                'request_position',
                'request_phone',
                'request_gender',
                'payment_date_origin',
                'is_unout_request',
                'record_type',
            ]);
    }

    protected static $staff_type = [
        1 => 'ថ្នាក់ដឹកនាំ General Manager/CEO',
        2 => 'ថ្នាក់ដឹកនាំគ្រប់គ្រង/កណ្ដាល (Supervisor)',
        3 => 'និយោជិតការិយាល័យ',
        4 => 'អ្នកជំនាញជាន់ខ្ពស់/កម្មករជំនាញ',
        5 => 'កម្មករ/បុគ្គលិក',
    ];

    public static function getStaffType(){
        return self::$staff_type;
    }
    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }
    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function staff(){
        return $this->hasMany('App\Models\StaffMovement\StaffMovementDetail', 'staff_movement_id');
    }

}
