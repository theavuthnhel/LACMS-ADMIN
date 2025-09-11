<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use SoftDeletes, HasFactory,
        HasRoles,
        Notifiable,
        LogsActivity,
        InteractsWithMedia;
        // AuthenticationLoggable;

    protected $table = 'users';

    protected static $logOnlyDirty = true;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	'name',
        'email',
        'phone_number',
        'password',
        'id_card_no',
        'dob',
        'active',
        'branch_id',
        'customer_id',
        'is_client',
        'is_company',
        'is_email',
        'is_id_card',
        'company_name_latin',
        'company_name_khmer',
        'company_tin',
        'business_activity',
        'business_house_no',
        'business_street',
        'business_group',
        'business_village',
        'business_commune',
        'business_district',
        'business_province',
        'company_register_number',
        'name_latin',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_status',
        'approved_at',
        'approved_by',
        'declined_at',
        'declined_by',
        'void_at',
        'void_by',
        'gender',
        'provincial_control',
        'pob_village',
        'pob_commune',
        'pob_district',
        'pob_province',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'address_house_no',
        'address_street',
        'address_group',
        'address_province',
        'address_district',
        'address_commune',
        'address_village',
        'emergency_name',
        'relationship',
        'emergency_phone',
        'emergency_phone_2',
        'doctor_id',
        'is_admin',
        'is_ministry',
        'is_child_company',
        'is_branch_company',
        'is_use_company_name',
        'is_use_owner_name',
        'mail_code',
        'mail_date',
        'is_super_approve',
        'is_registered_by_admin',
        'is_partner',
        'expired_date',
        'partner_id',
        'is_tvcms',
        'submitted_date',
        'department_id',
        'is_change_password',
        'change_password_at',
        'lover_name',
        'lover_dob',
        'total_sibling',
        'total_male_sibling',
        'total_female_sibling',
        'id_type',
        'id_expired_date',
        'two_factor_code',
        'two_factor_expires_at',
        'next_two_factor_at',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'name',
            'email',
            'phone_number',
            'password',
            'id_card_no',
            'dob',
            'active',
            'branch_id',
            'customer_id',
            'is_client',
            'is_company',
            'is_email',
            'is_id_card',
            'company_name_latin',
            'company_name_khmer',
            'company_tin',
            'business_activity',
            'business_house_no',
            'business_street',
            'business_group',
            'business_village',
            'business_commune',
            'business_district',
            'business_province',
            'company_register_number',
            'name_latin',
            'level_1',
            'level_2',
            'level_3',
            'level_4',
            'level_status',
            'approved_at',
            'approved_by',
            'declined_at',
            'declined_by',
            'void_at',
            'void_by',
            'gender',
            'provincial_control',
            'pob_village',
            'pob_commune',
            'pob_district',
            'pob_province',
            'house_no',
            'street',
            'group',
            'village',
            'commune',
            'district',
            'province',
            'address_house_no',
            'address_street',
            'address_group',
            'address_province',
            'address_district',
            'address_commune',
            'address_village',
            'emergency_name',
            'relationship',
            'emergency_phone',
            'emergency_phone_2',
            'doctor_id',
            'is_admin',
            'is_ministry',
            'is_child_company',
            'is_branch_company',
            'is_use_company_name',
            'is_use_owner_name',
            'mail_code',
            'mail_date',
            'is_super_approve',
            'is_registered_by_admin',
            'is_partner',
            'expired_date',
            'partner_id',
            'is_tvcms',
            'submitted_date',
            'department_id',
            'is_change_password',
            'change_password_at',
            'lover_name',
            'lover_dob',
            'total_sibling',
            'total_male_sibling',
            'total_female_sibling',
            'id_type',
            'id_expired_date',
        ])
        ->logOnlyDirty()
        ;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} User";
    }

    public function company(){
        return $this->hasOne('Modules\Company\Entities\Company', 'created_by');
    }
    public function partner()
    {
        return $this->belongsTo('Modules\Physical\Entities\PhysicalPartner', 'partner_id');
    }
    public function bio()
    {
        return $this->hasOne('Modules\Bio\Entities\Bio', 'created_by');
    }
    public function verify()
    {
        return $this->hasMany('Modules\User\Entities\UserVerify', 'user_id');
    }

    public function declined()
    {
        return $this->hasMany('Modules\User\Entities\UserDecline', 'user_id');
    }

    public function void()
    {
        return $this->hasMany('Modules\User\Entities\UserVoid', 'user_id');
    }
    public function findForPassport(string $username): User
    {
        return $this->where('email', $username)->orWhere("phone_number", $username)->first();
    }
    public function level()
    {
        return $this->hasManyThrough(
            'Modules\User\Entities\Level',
            'Modules\User\Entities\ModelHasRole',
            'model_id', // Foreign key on users table...
            'role_id', // Foreign key on history table...
            'id',
            'role_id'
        );
    }
    public function branch()
    {
        return $this->morphToMany("Modules\User\Entities\Branch", 'branchables');
    }
}
