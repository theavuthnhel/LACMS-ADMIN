<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class UpdateCompany extends Model implements HasMedia
{
    use InteractsWithMedia, LogsActivity, SoftDeletes;

    protected $table = "update_company";

    protected $primaryKey = "id";

    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;
    

    protected $fillable = [
        'company_id',
        'status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_6',
        'level_7',
        'level_status',
        'approved_at',
        'approved_by',
        'declined_at',
        'declined_by',
        'void_at',
        'void_by',            
        'payment_date',
        'payment_date_origin',
        'payment_status',
        'code',
        'certificate_code',
        'branch_id',
        'edit_status',
        'created_by',
        'updated_by',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'submitted_at',
        'letter_date',
    ];

    protected static $logAttributes = [ 
        'company_id',
        'status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_6',
        'level_7',
        'level_status',
        'approved_at',
        'approved_by',
        'declined_at',
        'declined_by',
        'void_at',
        'void_by',            
        'payment_date',
        'payment_date_origin',
        'payment_status',
        'code',
        'certificate_code',
        'branch_id',
        'edit_status',
        'created_by',
        'updated_by',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'submitted_at',
        'letter_date',
    ];

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly($this->fillable)
            ->logOnlyDirty()
            ->useLogName('update_company');
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

    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }

    public function update_detail(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id');
    }

    public function update_detail_old(){
        return $this->hasOne('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('type', 1);
    }

    public function update_detail_new(){
        return $this->hasOne('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('type', 2);
    }

    public function scopeCompany($query){
        if(\Auth::user()->is_company == 1)
            return $query->where('company_id', \Auth::user()->company->id);
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

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Inspection\UpdateCompanyVerify', 'request_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDeclined', 'request_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Inspection\UpdateCompanyVoid', 'request_id');
    }

    public function update_items(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id');
    }

    public function update_items_change_name_old(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 1)->where('type', 1)->first();
    }

    public function update_items_change_name_new(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 1)->where('type', 2)->first();
    }

    public function update_items_change_owner_old(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 2)->where('type', 1)->first();
    }

    public function update_items_change_owner_new(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 2)->where('type', 2)->first();
    }

    public function update_items_change_director_old(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 3)->where('type', 1)->first();
    }

    public function update_items_change_director_new(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 3)->where('type', 2)->first();
    }

    public function update_items_change_address_old(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 5)->where('type', 1)->first();
    }

    public function update_items_change_address_new(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 5)->where('type', 2)->first();
    }

    public function update_items_change_article_old(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 6)->where('type', 1)->first();
    }

    public function update_items_change_article_new(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 6)->where('type', 2)->first();
    }

    public function update_items_change_activities_old(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 7)->where('type', 1)->first();
    }

    public function update_items_change_activities_new(){
        return $this->hasMany('App\Models\Inspection\UpdateCompanyDetail', 'update_company_id')->where('record_type', 7)->where('type', 2)->first();
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

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Update Company";
    }
}
