<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class WorkingLogRequest extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes;

    protected $table = "working_log_request";

    protected $fillable = [
    	"working_history_id",
    	"type",
    	"status",
    	"printed_at",
    	"printed_by",
    	"created_by",
    	"updated_by",
        "branch_id",
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_status',
        'payment_status',
        'approved_at',
        'declined_at',
        'void_at',
        'approved_by',
        'declined_by',
        'void_by',
        'payment_date',
        'mail_code',
        'mail_expired_date',
        'deleted_at',
        'batch_id',
        'bio_id',
        'company_id',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'is_walk_in',
        'payment_date_origin',
        'submitted_at',
        'record_type',
    ];

    protected static $logAttributes = [
        "working_history_id",
    	"type",
    	"status",
    	"printed_at",
    	"printed_by",
    	"created_by",
    	"updated_by",
        "branch_id",
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_status',
        'payment_status',
        'approved_at',
        'declined_at',
        'void_at',
        'approved_by',
        'declined_by',
        'void_by',
        'payment_date',
        'mail_code',
        'mail_expired_date',
        'deleted_at',
        'batch_id',
        'bio_id',
        'company_id',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'is_walk_in',
        'payment_date_origin',
        'submitted_at',
        'record_type',
    ];

    public function createdBy(){
    	return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
    	return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function working_history()
    {
        return $this->belongsTo('App\Models\Bio\WorkingHistory', 'working_history_id');
    }

    public function bio()
    {
        return $this->belongsTo('App\Models\Bio\Bio', 'bio_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function scopeWorkingIn($query){
        return $query->whereIn('type', [1, 3]);
    }

    public function scopeWorkingOut($query){
        return $query->where('type', 2);
    }

    public function scopeChange($query){
        return $query->where('type', 3);
    }

    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Bio\WorkingLogRequestVerify', 'working_log_request_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Bio\WorkingLogRequestDecline', 'working_log_request_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Bio\WorkingLogRequestVoid', 'working_log_request_id');
    }

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

    public function scopeBranchs($query){
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
        // if(\Auth::user()->is_client != 1)
        //     if(\Auth::user()->is_admin != 1){
        //         // if(\Auth::user()->branch[0]->pluck('id')->implode('') != '26'){
        //             $branch = \Auth::user()->branch->pluck('id');
        //             return $query->whereIn('branch_id', $branch);
        //         // }
        //     }
    }

    public function scopeWalkIn($query){
        return $query->where('is_walk_in', 1);
    }

    public function scopePending($query){
        if(\Auth::user()->is_admin == 1){
            return $query->where('status', 0);
        }else{
            $level = \Auth::user()->level->pluck('right');
            $branch = \Auth::user()->branch->pluck('id');
            return $query->whereIn('branch_id', $branch)->where('status', 0)->whereIn('level_status', $level);
        }
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

    public function scopePendingAll($query){
        return $query->where('status', 0);
    }

    public function scopeCompany($query){
        if(\Auth::user()->is_company == 1)
            return $query->where('company_id', \Auth::user()->company->id);
    }

    public function scopeCreatedBy($query){
        if(\Auth::user()->can('bio:menu:scope_created_by'))
            return $query->where('created_by', \Auth::user()->id);
    }
}
