<?php

namespace App\Models\Physical;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Physical extends Model implements HasMedia
{
	use SoftDeletes, InteractsWithMedia, LogsActivity;

    protected $table = "physical_request";
    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'khmer_name',
        'latin_name',
        'dob',
        'gender',
        'id_number',
        'familybook_number',
        'birth_certificate_number',
        'doc_type',
        'phone_1',
        'status',
        'code',
        'approved_by',
        'approved_at',
        'company_name_khmer',
        'company_name_latin',
        'weight',
        'height',
        'chest',
        'pob_province',
        'pob_district',
        'pob_commune',
        'pob_village',
        'main_business_activity',
        'position',
        'is_disability',
        'payment_status',
        'payment_date',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_status',
        'control_province',
        'illness_history',
        'right_eye',
        'left_eye',
        'ear',
        'nose',
        'throat',
        'heart',
        'blood_pressure',
        'pulse',
        'liver',
        'genital',
        'nervse_system',
        'bone_marrow',
        'clinic',
        'test_ticket_number',
        'company_id',
        'blood_type',
        'rhesus',
        'test_ticket_name',
        'test_ticket_date',
        'nationality',
        'doctor_id',
        'approved_id',
        'online_status',
        'print_status',
        'print_date',
        'conclusion',
        'checkup_date',
        'batch_id',
        'edit_status',
        'created_by',
        'updated_by',
        'pob_fn',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'address_house_no',
        'address_street',
        'address_group',
        'address_province',
        'address_district',
        'address_commune',
        'address_village',
        'emergency_name',
        'emergency_phone',
        'emergency_phone_2',
        'relationship',
        'house_no',
        'street',
        'group',
        'province',
        'district',
        'commune',
        'village',
        'marrital_status',
        'spouse_name',
        'spouse_number',
        'payment_date_origin',
        'is_registered_by_partner',
        'registered_partner_id',
        'expired_date',
        'reference_number',
        'declined_by',
        'void_by',
        'declined_at',
        'void_at',
        'is_change',
        'update_doctor_by',
        'update_labo_by',
        'print_by',
        'physical_spot_id',
        'is_queue',
        'payment_delete_date',
        'id_type',
        'id_expired_date',
    ];

    protected static $logAttributes = [
    	'khmer_name',
        'latin_name',
        'dob',
        'gender',
        'id_number',
        'familybook_number',
        'birth_certificate_number',
        'doc_type',
        'phone_1',
        'status',
        'code',
        'approved_by',
        'approved_at',
        'company_name_khmer',
        'company_name_latin',
        'weight',
        'height',
        'chest',
        'pob_province',
        'pob_district',
        'pob_commune',
        'pob_village',
        'main_business_activity',
        'position',
        'is_disability',
        'payment_status',
        'payment_date',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_status',
        'control_province',
        'illness_history',
        'right_eye',
        'left_eye',
        'ear',
        'nose',
        'throat',
        'heart',
        'blood_pressure',
        'pulse',
        'liver',
        'genital',
        'nervse_system',
        'bone_marrow',
        'clinic',
        'blood_type',
        'rhesus',
        'test_ticket_name',
        'test_ticket_date',
        'nationality',
        'doctor_id',
        'approved_id',
        'online_status',
        'print_status',
        'print_date',
        'conclusion',
        'checkup_date',
        'batch_id',
        'edit_status',
        'created_by',
        'updated_by',
        'pob_fn',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'address_house_no',
        'address_street',
        'address_group',
        'address_province',
        'address_district',
        'address_commune',
        'address_village',
        'emergency_name',
        'emergency_phone',
        'emergency_phone_2',
        'relationship',
        'house_no',
        'street',
        'group',
        'province',
        'district',
        'commune',
        'village',
        'payment_date_origin',
        'is_registered_by_partner',
        'registered_partner_id',
        'expired_date',
        'reference_number',
        'declined_by',
        'void_by',
        'declined_at',
        'void_at',
        'is_change',
        'update_doctor_by',
        'update_labo_by',
        'print_by',
        'physical_spot_id',
        'is_queue',
        'payment_delete_date',
        'id_type',
        'id_expired_date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'khmer_name',
                'latin_name',
                'dob',
                'gender',
                'id_number',
                'familybook_number',
                'birth_certificate_number',
                'doc_type',
                'phone_1',
                'status',
                'code',
                'approved_by',
                'approved_at',
                'company_name_khmer',
                'company_name_latin',
                'weight',
                'height',
                'chest',
                'pob_province',
                'pob_district',
                'pob_commune',
                'pob_village',
                'main_business_activity',
                'position',
                'is_disability',
                'payment_status',
                'payment_date',
                'level_1',
                'level_2',
                'level_3',
                'level_4',
                'level_status',
                'control_province',
                'illness_history',
                'right_eye',
                'left_eye',
                'ear',
                'nose',
                'throat',
                'heart',
                'blood_pressure',
                'pulse',
                'liver',
                'genital',
                'nervse_system',
                'bone_marrow',
                'clinic',
                'blood_type',
                'rhesus',
                'test_ticket_name',
                'test_ticket_date',
                'nationality',
                'doctor_id',
                'approved_id',
                'online_status',
                'print_status',
                'print_date',
                'conclusion',
                'checkup_date',
                'batch_id',
                'edit_status',
                'created_by',
                'updated_by',
                'pob_fn',
                'request_name',
                'request_position',
                'request_phone',
                'request_gender',
                'address_house_no',
                'address_street',
                'address_group',
                'address_province',
                'address_district',
                'address_commune',
                'address_village',
                'emergency_name',
                'emergency_phone',
                'emergency_phone_2',
                'relationship',
                'house_no',
                'street',
                'group',
                'province',
                'district',
                'commune',
                'village',
                'payment_date_origin',
                'is_registered_by_partner',
                'registered_partner_id',
                'expired_date',
                'reference_number',
                'declined_by',
                'void_by',
                'declined_at',
                'void_at',
                'is_change',
                'update_doctor_by',
                'update_labo_by',
                'print_by',
                'physical_spot_id',
                'is_queue',
                'payment_delete_date',
                'id_type',
                'id_expired_date',
            ]);
    }

    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }

    public function tracking()
    {
        return $this->morphToMany('App\Models\Tracking', 'trackingables');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function doctors()
    {
        return $this->belongsTo('App\Models\Physical\Doctor', 'doctor_id');
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function approvedBy(){
        return $this->belongsTo('App\Models\User\User', 'approved_by');
    }

    public function declinedBy(){
        return $this->belongsTo('App\Models\User\User', 'declined_by');
    }

    public function voidBy(){
        return $this->belongsTo('App\Models\User\User', 'void_by');
    }

    public function doctorUpdate(){
        return $this->belongsTo('App\Models\User\User', 'update_doctor_by');
    }

    public function laboUpdate(){
        return $this->belongsTo('App\Models\User\User', 'update_labo_by');
    }

    public function printBy(){
        return $this->belongsTo('App\Models\User\User', 'print_by');
    }

    public function main_business_activities(){
        return $this->belongsTo('App\Models\StaffMovement\BusinessActivity', 'main_business_activity');
    }

    public function nationalities(){
        return $this->belongsTo('App\Models\Bio\Nationality', 'nationality');
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Physical\PhysicalVerify', 'physical_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Physical\PhysicalDecline', 'physical_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Physical\PhysicalVoid', 'physical_id');
    }

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
    }

    public function partners()
    {
        return $this->belongsTo('App\Models\Physical\PhysicalPartner', 'registered_partner_id');
    }

    public function physical_spot()
    {
        return $this->belongsTo('App\Models\Physical\PhysicalSpot', 'physical_spot_id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Physical Certificate";
    }

    public function scopeCompany($query){
        if(\Auth::user()->is_company == 1)
            return $query->where('company_id', \Auth::user()->company->id);
    }

    public function scopeRegisteredByPartner($query){
        if(\Auth::user()->is_partner == 1)
            return $query->where('registered_partner_id', \Auth::user()->partner_id);
    }

    public function scopeOnline($query){
        return $query->where('online_status', '=', 0);
    }

    public function scopePayment($query){
        return $query->where('payment_status', '=', 1);
    }

    public function scopeWalkin($query){
        return $query->whereIn('online_status', [1,3]);
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
