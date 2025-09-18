<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia};
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;

class Suspension extends Model implements HasMedia{

    use InteractsWithMedia, SoftDeletes, LogsActivity;

	protected $table = "suspension";

	protected $primaryKey = "id";

	protected $dates = ['deleted_at'];

    protected $with = ['company'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
        'request_worker_total',
        'request_worker_female',
        'total_staff',
        'total_female_staff',
        'start_date',
        'end_date',
        'total_day',
        'reason',
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
        'submit_document',
        'letter_date',
        'record_type',
        'business_activity',
        'main_product_type',
        'main_product_detail',
        'brand',
        'export_country',
        'bank_account',
        'bank_name',
        'allowance',
        'allowance_type'
    ];

    protected static $logAttributes = [
    	'company_id',
        'request_worker_total',
        'request_worker_female',
        'total_staff',
        'total_female_staff',
        'start_date',
        'end_date',
        'total_day',
        'reason',
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
        'submit_document',
        'letter_date',
        'record_type',
        'business_activity',
        'main_product_type',
        'main_product_detail',
        'brand',
        'export_country',
        'bank_account',
        'bank_name',
        'allowance',
        'allowance_type'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function detail(){
        return $this->hasMany('App\Models\Inspection\SuspensionDetail', 'suspension_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
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

    private function authUser()
    {
        return Auth::user();
    }

    public function scopeCompany($query)
    {

        if($this->authUser()->is_company != 1) return;

        return $query->where('company_id', $this->authUser()->company->id);
    }

    public function scopePending($query)
    {

        $user = $this->authUser();

        $query = $query->where('status', 0);

        if ($user->is_admin == 1) {
            return $query;
        }

        $levelRights = $user->level->pluck('right');

        return $query->whereIn('level_status', $levelRights);
    }

    public function scopePendingAll($query)
    {
        return $query->where('status', 0);
    }

    public function scopeBranchs($query)
    {
        $user = $this->authUser();

        if ($user->is_client == 1 || $user->is_admin == 1 ||
            $user->branch[0]->id == 26 || $user->provincial_control == 1
        ) {
            return;
        }

        $branch = $user->branch->pluck('code');
        return $query->whereHas('company', function ($query) use ($branch) {
                    $query->whereIn('province', $branch);
                });
    }

    public function scopePendingBranchs($query)
    {
        $user = $this->authUser();

        if ($user->is_client == 1 || $user->is_admin == 1 ||
            $user->branch[0]->id == 26 || $user->provincial_control == 1
        ) {
            return;
        }

        $branch = $this->authUser()->branch->pluck('id');
        return $query->whereIn('branch_id', $branch);

    }

    public function verify()
    {
        return $this->hasMany('App\Models\Inspection\SuspensionVerify', 'suspension_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Inspection\SuspensionDecline', 'suspension_id');
    }

    public function branching()
    {
        return $this->hasOne('App\Models\User\Branch', 'id', 'branch_id');
    }

    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Suspension";
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
            case 5:
                return __('inspection::inspection.submit');
            case 6:
                return __('inspection::inspection.feedback_for_document');
        }
    }
}
