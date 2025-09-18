<?php

namespace App\Models\Registration;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class Registration extends Model implements HasMedia
{
	use SoftDeletes, InteractsWithMedia, LogsActivity;

    protected $table = "registration_company";

    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'single_id',
        'company_id',
        'code',
        'khmer_name',
        'latin_name',
        'date_of_create',
        'address_of_manage_authority',
        'company_phone_number',
        'company_email',
        'name_of_owner',
        'nationality_of_owner',
        'name_of_director',
        'nationality_of_director',
        'article_of_company',
        'business_objective',
        'main_business_activities',
        'others_business_activities',
        'address',
        'phone_number',
        'email',
        'estimate_staff_amount',
        'estimate_female_staff_amount',
        'foreign_staff_amount',
        'foreign_female_staff_amount',
        'dangerous_status',
        'working_hours',
        'working_hours_type',
        'address_house_no',
        'address_street',
        'address_group',
        'address_province_code',
        'address_district_code',
        'address_commune_code',
        'address_village_code',
        'house_no',
        'street',
        'group',
        'province_code',
        'district_code',
        'commune_code',
        'village_code',
        'address_of_manage_authority_en',
        'name_of_owner_en',
        'nationality_of_owner_en',
        'name_of_director_en',
        'nationality_of_director_en',
        'article_of_company_en',
        'address_en',
        'status',
        'comment',
        'control_province',
        'submitted_at',
        'approved_at',
        'approved_by',
        'created_by',
        'updated_by',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_status',
        'payment_status',
        'payment_date',
        'edit_status',
        'business_objective_input',
        'business_objective_input_en',
        'certificate_code',
        'request_name',
        'request_position',
        'request_phone',
        'is_subsidiary',
        'is_oversea',
        'oversea_address',
        'business_activities_by_patent',
        'business_activities_by_patent_en',
        'request_gender',
        'payment_date_origin',
        'declined_by',
        'void_by',
        'declined_at',
        'void_at',
        'record_type',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly( [
                'single_id',
                'company_id',
                'code',
                'khmer_name',
                'latin_name',
                'date_of_create',
                'address_of_manage_authority',
                'company_phone_number',
                'company_email',
                'name_of_owner',
                'nationality_of_owner',
                'name_of_director',
                'nationality_of_director',
                'article_of_company',
                'business_objective',
                'main_business_activities',
                'others_business_activities',
                'address',
                'phone_number',
                'email',
                'estimate_staff_amount',
                'estimate_female_staff_amount',
                'foreign_staff_amount',
                'foreign_female_staff_amount',
                'dangerous_status',
                'working_hours',
                'working_hours_type',
                'address_province_code',
                'address_district_code',
                'address_commune_code',
                'address_village_code',
                'province_code',
                'district_code',
                'commune_code',
                'village_code',
                'address_of_manage_authority_en',
                'name_of_owner_en',
                'nationality_of_owner_en',
                'name_of_director_en',
                'nationality_of_director_en',
                'article_of_company_en',
                'address_en',
                'status',
                'comment',
                'control_province',
                'submitted_at',
                'approved_date',
                'approved_by',
                'created_by',
                'updated_by',
                'level_1',
                'level_2',
                'level_3',
                'level_4',
                'level_5',
                'level_status',
                'payment_status',
                'payment_date',
                'edit_status',
                'business_objective_input',
                'business_objective_input_en',
                'certificate_code',
                'request_name',
                'request_position',
                'request_phone',
                'is_subsidiary',
                'is_oversea',
                'oversea_address',
                'business_activities_by_patent',
                'business_activities_by_patent_en',
                'request_gender',
                'payment_date_origin',
                'declined_by',
                'void_by',
                'declined_at',
                'void_at',
                'record_type',
            ]);
    }
    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }
    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }
    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }
    public function tracking()
    {
        return $this->morphToMany('App\Models\Tracking', 'trackingables');
    }

    public function patent()
    {
        return $this->hasMany('App\Models\Registration\Patent', 'registration_id');
    }

}
