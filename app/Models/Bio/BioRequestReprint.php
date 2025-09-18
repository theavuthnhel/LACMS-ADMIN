<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BioRequestReprint extends Model implements HasMedia
{

    use LogsActivity, SoftDeletes, InteractsWithMedia;

    #Request Reasons
    const BROKEN = 0; #បាត់ ឬ ខូចខាត
    const FINISH = 1; #អស់សន្លឺកទិដ្ឋាការចេញចូល
    const CHANGE = 2; #ផ្លាស់ប្តូរតួនាទី

    #Request Status
    const PENDING = 0;
    const APPROVED = 1;
    const DECLINED = 2;
    const VOID = 3;

    #Print Status
    const PRINT_PENDING = 0;
    const PRINT_READY = 1;

    protected $primaryKey = "id";
    protected $table = "request_print_book";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'bio_id',
        'reasons_type',
        'request_status',
        'printed_at',
        'printed_by',
        'created_by',
        'updated_by',
        'branch_id',
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
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'is_walk_in',
        'payment_date_origin',
        'print_status',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'bio_id',
                'reasons_type',
                'request_status',
                'printed_at',
                'printed_by',
                'created_by',
                'updated_by',
                'branch_id',
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
                'request_name',
                'request_position',
                'request_phone',
                'request_gender',
                'is_walk_in',
                'payment_date_origin',
                'print_status',
            ]);
    }
    public function bio()
    {
        return $this->belongsTo('App\Models\Bio\Bio', 'bio_id');
    }

    public function printedBy(){
        return $this->belongsTo('App\Models\User\User', 'printed_by');
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Bio\ReqeustPrintVerify', 'request_print_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Bio\RequestPrintDeclined', 'request_print_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Bio\RequestPrintVoid', 'request_print_id');
    }

    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

    public function scopeBranchs($query){
        if(Auth::user()->is_admin != 1){
            if(Auth::user()->branch[0]->id != '26' && Auth::user()->provincial_control != 1){
                $branch = Auth::user()->branch->pluck('code');
                return $query->whereHas('company', function($query) use ($branch) {
                           $query->whereIn('province', $branch);
                        });
            }
            // else{
            //     $branch = Auth::user()->branch->pluck('id');
            //     return $query->whereIn('branch_id', $branch);
            // }
        }
    }

    public function scopePendingBranchs($query){
        if(Auth::user()->is_client != 1){
            if(Auth::user()->is_admin != 1){
                if(Auth::user()->branch[0]->id != '26'){
                    $branch = Auth::user()->branch->pluck('id');
                    return $query->whereIn('branch_id', $branch);
                }
            }
        }
    }

    public function scopePending($query){
        if(Auth::user()->is_admin == 1){
            return $query->where('request_status', 0);
        }else{
            $level = Auth::user()->level->pluck('right');
            $branch = Auth::user()->branch->pluck('id');
            return $query->where('request_status', 0)->where('branch_id', $branch)->whereIn('level_status', $level);
        }
    }

    public function scopePendingAll($query){
        return $query->where('request_status', 0);
    }

    public function scopeCreatedBy($query){
        if(Auth::user()->can('bio:menu:scope_created_by'))
            return $query->where('created_by', Auth::user()->id);
    }
}
