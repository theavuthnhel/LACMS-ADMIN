<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class Account extends Model implements HasMedia
{
	use InteractsWithMedia, LogsActivity, SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $table = "account";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'account_id',
        'type',
        'amount_due',
        'client_name',
        'bank_name',
        'bank_reference_id',
        'paid_date',
        'paid_time',
        'invoice_no',
        'currency',
        'branch_id',
        'service_name',
        'nbc',
        'mlvt',
        'mef',
        'mef_charity',
        'provincial',
        'provincial_account',
        'provincial_control',
        'cut_off_date',
        'aba',
        'sathapana',
        'acleda',
        'created_by',
        'updated_by',
        'payment_type',
        'payment_status',
        'is_new_service',
        'province_amount',
        'mlvt_amount'
    ];

    protected static $logAttributes = [
    	'account_id',
        'type',
        'amount_due',
        'client_name',
        'bank_name',
        'bank_reference_id',
        'paid_date',
        'paid_time',
        'invoice_no',
        'currency',
        'branch_id',
        'service_name',
        'nbc',
        'mlvt',
        'mef',
        'mef_charity',
        'provincial',
        'provincial_account',
        'provincial_control',
        'cut_off_date',
        'aba',
        'sathapana',
        'acleda',
        'created_by',
        'updated_by',
        'payment_type',
        'payment_status',
        'is_new_service',
        'province_amount',
        'mlvt_amount'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'account_id',
                'type',
                'amount_due',
                'client_name',
                'bank_name',
                'bank_reference_id',
                'paid_date',
                'paid_time',
                'invoice_no',
                'currency',
                'branch_id',
                'service_name',
                'nbc',
                'mlvt',
                'mef',
                'mef_charity',
                'provincial',
                'provincial_account',
                'provincial_control',
                'cut_off_date',
                'aba',
                'sathapana',
                'acleda',
                'created_by',
                'updated_by',
                'payment_type',
                'payment_status',
                'is_new_service',
                'province_amount',
                'mlvt_amount'
            ]);
    }

    public function accountables()
    {
        return $this->hasMany('App\Models\Account\Accountables', 'account_id');
    }

    public function bio()
    {
        return $this->morphedByMany('App\Models\Bio\Bio', 'accountables');
    }

    public function children()
    {
        return $this->morphedByMany('App\Models\Children\RequestChildren', 'accountables');
    }

    public function staffmovement()
    {
        return $this->morphedByMany('App\Models\StaffMovement\StaffMovement', 'accountables');
    }

    public function physical()
    {
        return $this->morphedByMany('App\Models\Physical\Physical', 'accountables');
    }

    public function physicallabour()
    {
        return $this->morphedByMany('App\Models\Physical\PhysicalLabour', 'accountables');
    }

    public function reprint()
    {
        return $this->morphedByMany('App\Models\Bio\BioRequestReprint', 'accountables');
    }

    public function visa()
    {
        return $this->morphedByMany('App\Models\Bio\WorkingLogRequest', 'accountables');
    }

    public function vote()
    {
        return $this->morphedByMany('App\Models\Vote\Vote', 'accountables');
    }

    public function request_ot()
    {
        return $this->morphedByMany('App\Models\Inspection\RequestOT', 'accountables');
    }

    public function request_ir()
    {
        return $this->morphedByMany('App\Models\Inspection\RequestIR', 'accountables');
    }

    public function apprenticeship()
    {
        return $this->morphedByMany('App\Models\Apprenticeship\Apprenticeship', 'accountables');
    }

    public function school()
    {
        return $this->morphedByMany('App\Models\School\School', 'accountables');
    }

    public function request_book_payroll()
    {
        return $this->morphedByMany('App\Models\Inspection\RequestBookPayroll', 'accountables');
    }

    public function registration()
    {
        return $this->morphedByMany('App\Models\Registration\Registration', 'accountables');
    }

    public function suspension()
    {
        return $this->morphedByMany('App\Models\Inspection\Suspension', 'accountables');
    }

    public function physical_spot()
    {
        return $this->morphedByMany('App\Models\Physical\PhysicalSpot', 'accountables');
    }

    public function update_company()
    {
        return $this->morphedByMany('App\Models\Inspection\UpdateCompany', 'accountables');
    }

    public function createdBy(){
    	return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
    	return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function branchs()
    {
        return $this->hasOne('App\Models\User\Branch', 'id', 'branch_id');
    }

    public function getFullDateAttribute()
    {
        return "{$this->paid_date} {$this->paid_time}";
    }

    public function scopeBranchs($query){
        if(\Auth::user()->is_client != 1)
            if(\Auth::user()->is_admin != 1){
                if(\Auth::user()->branch[0]->pluck('id') != '26'){
                    $branch = \Auth::user()->branch->pluck('id');
                    return $query->whereIn('branch_id', $branch);
                }
            }
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} BIO";
    }
}
