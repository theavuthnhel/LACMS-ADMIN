<?php

namespace App\Models\Bio;

use App\Models\Tracking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Bio extends Model implements HasMedia
{
    # Update

    use InteractsWithMedia, LogsActivity, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "bio";

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'branch_id',
        'name',
        'gender',
        'height',
        'nationality',
        'id_number',
        'dob',
        'pob_group',
        'pob_village',
        'pob_commune',
        'pob_district',
        'pob_province',
        'fax',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'created_by',
        'updated_by',
        'education',
        'skill',
        'position',
        'start_working_date',
        'salary',
        'id_number',
        'company_id',
        'status',
        'payment_status',
        'payment_date',
        'emergency_name',
        'emergency_phone',
        'name_latin',
        'created_by',
        'updated_by',
        'business_house_no',
        'business_street',
        'business_group',
        'business_village',
        'business_commune',
        'business_district',
        'business_province',
        'company_name_latin',
        'company_name_khmer',
        'company_tin',
        'doc_type',
        'familybook_number',
        'birth_certificate_number',
        'code',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_6',
        'level_7',
        'level_8',
        'level_status',
        'emergency_phone_2',
        'business_activity',
        'physical_certificate_issued_at',
        'delivered_at',
        'delivered_by',
        'delivered_status',
        'position_category',
        'company_register_number',
        'main_business_activity',
        'batch_id',
        'approved_at',
        'print_at',
        'print_by',
        'declined_at',
        'void_at',
        'void_by',
        'personal_phone',
        'address_province',
        'address_district',
        'address_commune',
        'address_village',
        'education_1',
        'address_house_no',
        'address_street',
        'address_group',
        'relationship',
        'print_card_status',
        'print_status',
        'osh_number',
        'bio_type',
        'book_id',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'phone_2',
        'marrital_status',
        'spouse_name',
        'spouse_number',
        'is_walk_in',
        'salary_in_type',
        'working_hour',
        'staff_type',
        'book_number',
        'paid_by',
        'is_off_line_physical',
        'reprint_date',
        'reprinted_by',
        'payment_date_origin',
        'company_origin',
        'wing_account_create_status',
        'wing_account_create_date',
        'wing_print_card_status',
        'wing_print_card_date',
        'wing_account_number',
        'nssf_id',
        'covid19_vaccination_card_id',
        'wing_status',
        'wing_sent_date',
        'is_not_send_to_wing',
        'self_print_request_id',
        'self_print_request_book_id',
        'id_type',
        'id_expired_date',
        'working_role',
        'is_registered_by_client',
        'is_notify',
        'notify_date',
        'accepted_at',
        'card_downloaded_at',
        'is_new_version',
    ];


    protected static $business_activity = [
        18 => 'កាត់ដេរ',
        19 => 'វាយនភណ្ឌ',
        20 => 'ស្បែកជើង',
        21 => 'ផលិតផលធ្វើដំណើរនិងកាបូប',
        1 => 'សហគ្រាស គ្រឹះស្ថានដែលបម្រើឱ្យការនាំចេញ',
        2 => 'ធ្វើអាជីវកម្មកាសុីណូ',
        3 => 'ស្ថិតក្នុងតំបន់សេដ្ឋកិច្ចពិសេស',
        // // 16 => 'ការអប់រំ',
        4 => 'រមណីយដ្ឋាន និងសណ្ឋាគារកម្រិតចាប់ពីផ្កាយបួនឡើង',
        5 => 'ទីភ្នាក់ងារជ្រើសរើសឯកជន',
        // 6 => 'ក្រុមហ៊ុនអាកាសចរណ៍',
        // 7 => 'ក្រុមហ៊ុននាវាចរណ៍',
        8 => 'ស្នាក់ការកណ្ដាលគ្រឹះស្ថានធនាគារនិងហិរញ្ញវត្ថុ',
        // 9 => 'ស្នាក់ការកណ្ដាលក្រុមហ៊ុនអភិវឌ្ឍន៍អចលនវត្ថុ',
        // 10 => 'អង្គការសង្គមសុីវិល',
        // 17 => 'រោងចក្រ សហគ្រាសដែលមានកម្មករនិយោជិតសរុបក្រោម ១០១នាក់ ក្រៅពីសកម្មភាពសេដ្ឋកិច្ចខាងលើ',
        22 => 'សហគ្រាស គ្រឹះស្ថានដែលមិនបម្រើឱ្យការនាំចេញ',
        11 => 'រមណីយដ្ឋាន និងសណ្ឋាគារកម្រិតក្រោមផ្កាយបីចុះ',
        12 => 'សាខាគ្រឹះស្ថានធនាគារនិងហិរញ្ញវត្ថុ',
        // 13 => 'សាខាក្រុមហ៊ុនអភិវឌ្ឍន៍អចលនវត្ថុ',
        // 14 => 'សាខាអង្គការសង្គមសុីវិល',
        // 15 => 'ផ្សេងៗ'
    ];

    protected static $working_role_list = [
        1 => 'មុខរបរងាយៗ',
        2 => 'កម្មករនិយោជិត',
        3 => 'ប្រធានក្រុម',
        4 => 'ប្រធានផ្នែក',
        5 => 'នាយកប្រតិបត្តិ/Manager/CEO/Managing Director'
    ];

    protected static $marrital_status = [
        1 => 'នៅលីវ',
        2 => 'រៀបការ',
        3 => 'លែងលះ',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'branch_id',
                'name',
                'gender',
                'height',
                'nationality',
                'id_number',
                'dob',
                'pob_group',
                'pob_village',
                'pob_commune',
                'pob_district',
                'pob_province',
                'fax',
                'house_no',
                'street',
                'group',
                'village',
                'commune',
                'district',
                'province',
                'created_by',
                'updated_by',
                'education',
                'skill',
                'position',
                'start_working_date',
                'salary',
                'id_number',
                'company_id',
                'status',
                'payment_status',
                'payment_date',
                'emergency_name',
                'emergency_phone',
                'name_latin',
                'created_by',
                'updated_by',
                'business_house_no',
                'business_street',
                'business_group',
                'business_village',
                'business_commune',
                'business_district',
                'business_province',
                'company_name_latin',
                'company_name_khmer',
                'company_tin',
                'doc_type',
                'familybook_number',
                'birth_certificate_number',
                'code',
                'level_1',
                'level_2',
                'level_3',
                'level_4',
                'level_5',
                'level_6',
                'level_7',
                'level_8',
                'level_status',
                'emergency_phone_2',
                'business_activity',
                'physical_certificate_issued_at',
                'delivered_at',
                'delivered_by',
                'delivered_status',
                'position_category',
                'company_register_number',
                'main_business_activity',
                'batch_id',
                'approved_at',
                'print_at',
                'print_by',
                'declined_at',
                'void_at',
                'void_by',
                'personal_phone',
                'address_province',
                'address_district',
                'address_commune',
                'address_village',
                'education_1',
                'address_house_no',
                'address_street',
                'address_group',
                'relationship',
                'print_card_status',
                'print_status',
                'osh_number',
                'bio_type',
                'book_id',
                'request_name',
                'request_position',
                'request_phone',
                'request_gender',
                'phone_2',
                'marrital_status',
                'spouse_name',
                'spouse_number',
                'is_walk_in',
                'salary_in_type',
                'working_hour',
                'staff_type',
                'book_number',
                'paid_by',
                'is_off_line_physical',
                'reprint_date',
                'reprinted_by',
                'payment_date_origin',
                'company_origin',
                'wing_account_create_status',
                'wing_account_create_date',
                'wing_print_card_status',
                'wing_print_card_date',
                'wing_account_number',
                'nssf_id',
                'covid19_vaccination_card_id',
                'wing_status',
                'wing_sent_date',
                'is_not_send_to_wing',
                'self_print_request_id',
                'self_print_request_book_id',
                'id_type',
                'id_expired_date',
                'working_role',
                'is_registered_by_client',
                'is_notify',
                'notify_date',
            ]);
    }

    public static function getBusinessActivity()
    {
        return self::$business_activity;
    }

    public static function getWorkingRoleList()
    {
        return self::$working_role_list;
    }

    public static function getMarritalStatus()
    {
        return self::$marrital_status;
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }

    public function educations()
    {
        return $this->belongsTo('App\Models\Bio\Education', 'education');
    }
    public function educations_1()
    {
        return $this->belongsTo('App\Models\Bio\Education', 'education_1');
    }

    public function reprint()
    {
        return $this->hasMany('App\Models\Bio\BioRequestReprint', 'bio_id');
    }

    public function visa()
    {
        return $this->hasManyThrough('App\Models\Bio\WorkingLogRequest', 'App\Models\Bio\WorkingHistory', 'bio_id', 'working_history_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function working()
    {
        return $this->hasMany("App\Models\Bio\WorkingHistory", 'bio_id');
    }

    public function scopeAgedOver18($query)
    {
        return $query->whereDate(DB::raw("STR_TO_DATE(dob, '%d-%m-%Y')"), '<=', now()->subYears(18));
    }

    public function scopeAgedBelow18($query)
    {
        return $query->whereDate(DB::raw("STR_TO_DATE(dob, '%d-%m-%Y')"), '>', now()->subYears(18));
    }
    public function tracking()
    {
        return $this->morphToMany(Tracking::class, 'trackingables');
    }
    public function declined()
    {
        return $this->hasMany('App\Models\Bio\BioDecline', 'bio_id');
    }
    public function verify()
    {
        return $this->hasMany('App\Models\Bio\BioVerify', 'bio_id');
    }

    public function scopeChange($query)
    {
        return $query->whereNotIn('id', function ($query) {
            $query->select('bio_id')
                ->from('working_log_request')
                ->whereNotNull('bio_id')
                ->whereNull('deleted_at')
                ->whereIn('status', [0, 2, 4, 5]);
        })->where('status', 1);
    }


    public function scopeCompany($query){
        if(Auth::user()->is_company == 1)
            return $query->where('company_id', Auth::user()->company->id);
    }

    public function scopeReprint($query){
        return $query->whereNotIn('id', function ($query) {
            $query->select('bio_id')
                ->from('request_print_book')
                ->whereNotNull('bio_id')
                ->whereNull('deleted_at')
                ->whereIn('request_status', [0, 2, 4, 5]);
        })->where('status', 1);
    }

}
