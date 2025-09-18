<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class RequestBookPayroll extends Model implements HasMedia
{
    use InteractsWithMedia, LogsActivity, SoftDeletes;

	protected $table = "request_book_payroll";

	protected $primaryKey = "id";

	protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
    	'request_type',
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
        'provincial_control',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'approved_id',
        'salary',
        'salary_position',
        'normal_working_day',
        'salary_normal_working_day',
        'ot_normal',
        'salary_ot_normal',
        'ot_sunday',
        'salary_ot_sunday',
        'ot_holiday',
        'salary_ot_holiday',
        'other_salary',
        'sub_total_salary',
        'deduct_salary',
        'total_salary',
        'history_salary',
        'other_advantage',
        'open_salary',
        'marital_status',
        'rewards',
        'history_rewards',
        'housing_rewards',
        'ot_meals',
        'accommodation',
        'provision_of_logistics',
        'payment_date_origin',
        'record_type',
    ];

    protected static $logAttributes = [
    	'company_id',
        'request_type',
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
        'provincial_control',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'approved_id',
        'salary',
        'salary_position',
        'normal_working_day',
        'salary_normal_working_day',
        'ot_normal',
        'salary_ot_normal',
        'ot_sunday',
        'salary_ot_sunday',
        'ot_holiday',
        'salary_ot_holiday',
        'other_salary',
        'sub_total_salary',
        'deduct_salary',
        'total_salary',
        'history_salary',
        'other_advantage',
        'open_salary',
        'marital_status',
        'rewards',
        'history_rewards',
        'housing_rewards',
        'ot_meals',
        'accommodation',
        'provision_of_logistics',
        'payment_date_origin',
        'record_type',
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

    public function company(){
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function scopeCompany($query){
        if(\Auth::user()->is_company == 1)
            return $query->where('company_id', \Auth::user()->company->id);
    }

    public function scopePending($query){
        if(\Auth::user()->is_admin == 1){
            return $query->where('status', 0);
        }else{
            $level = \Auth::user()->level->pluck('right');
            // if(\Auth::user()->provincial_control == 1)
            //     return $query->where('status', 0)->where('provincial_control', 1)->whereIn('level_status', $level);
            // else
            $branch = \Auth::user()->branch->pluck('id');
            return $query->where('status', 0)->whereIn('branch_id', $branch)->whereIn('level_status', $level);
        }
    }

    public function scopePendingAll($query){
        return $query->where('status', 0);
    }

    public function scopePayment($query){
        return $query->where('payment_status', '=', 1);
    }


    public function scopeRequestBook($query){
        return $query->where('request_type', 1);
    }

    public function scopeRequestBookPayroll($query){
        return $query->whereIn('request_type', [2,3]);
    }

    public function scopeRequestPayrollComputer($query){
        return $query->where('request_type', 3);
    }

    public function scopeBranchs($query){
        if(\Auth::user()->is_client != 1){
            if(\Auth::user()->is_admin != 1){
                if(\Auth::user()->branch[0]->id != '26' && \Auth::user()->provincial_control != 1){
                    $branch = \Auth::user()->branch->pluck('code');
                    return $query->whereHas('company', function($query) use ($branch) {
                        $query->whereIn('province', $branch);
                    });
                }
                // else{
                //     $branch = \Auth::user()->branch->pluck('id');
                //     return $query->whereIn('branch_id', $branch);
                // }
            }
        }
        // if(\Auth::user()->is_admin != 1){
        //     $branch = \Auth::user()->branch->pluck('id');
        //     // if(\Auth::user()->provincial_control == 1)
        //     //     return $query->whereIn('branch_id', $branch)->where('provincial_control', 1);
        //     // else
        //         return $query->whereIn('branch_id', $branch);
        // }
    }

    public function scopePendingBranchs($query){
        if(\Auth::user()->is_client != 1){
            if(\Auth::user()->is_admin != 1){
                if(\Auth::user()->branch[0]->id != '26'){
                    $branch = \Auth::user()->branch->pluck('id');
                    return $query->whereIn('branch_id', $branch);
                }
            }
        }
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Inspection\RequestBookPayrollVerify', 'request_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Inspection\RequestBookPayrollDecline', 'request_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Inspection\RequestBookPayrollVoid', 'request_id');
    }

    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }



    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

    public function branching()
    {
        return $this->hasOne('App\Models\User\Branch', 'id', 'branch_id');
    }

    public function tracking()
    {
        return $this->morphToMany('App\Tracking', 'trackingables');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} request book payroll";
    }

    public function getStatusTranslateAttribute()
    {
        switch ($this->status) {
            case 0:
                return __('bio::bio.pending');
            case 1:
                return __('bio::bio.approved');
            case 2:
                return __('bio::bio.declined');
            case 3:
                return __('bio::bio.void');
            case 4:
                return __('bio::bio.preparing');
        }
    }






}
