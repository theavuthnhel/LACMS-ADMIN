<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Company extends Model implements HasMedia
{
    # Add Comment

    use InteractsWithMedia, LogsActivity, SoftDeletes;

    protected $table = "company";

    protected $primaryKey = "id";
    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'code',
        'company_name_khmer',
        'company_name_latin',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'created_by',
        'updated_by',
        'company_tin',
        'business_activity',
        'company_register_number',
        'branch_id',
        'user_id',
        'telephone',
        'owner_name',
        'owner_nationality',
        'director_name',
        'director_nationality',
        'main_business_activity',
        'main_product',
        'article_of_company',
        'registration_date',
        'business_activity_input',
        'owner_email',
        'owner_phone',
        'director_email',
        'director_phone',
        'hr_phone_1',
        'hr_phone_2',
        'hr_email_1',
        'hr_email_2',
        'secretary_name',
        'owner_gender',
        'director_gender',
        'owner_khmername',
        'director_khmername',
        'owner_id_number',
        'company_phone_number',
        'company_email',
        'provincial_control',
        'total_staff',
        'total_staff_female',
        'is_factory',
        'company_name_khmer_type',
        'is_updated',
        'nssf_id',
        'nssf_secondary_id',
        'nssf_company_id',
        'hr_name_kh',
        'hr_name_en',
        'director_id_number',
        'head_phone',
        'head_email',
        'head_house_no',
        'head_street',
        'head_group',
        'head_village',
        'head_commune',
        'head_district',
        'head_province',
        'head_phone_number',
        'head_email',
        'working_durations',
        'main_business_activity_2',
        'main_business_activity_3',
        'main_business_activity_4',
        'sme_type',
        'business_objective_input',
        'business_objective_input_en',
        'is_child_company',
        'is_branch_company',
        'camdx_business_objective',
        'camdx_main_business_activities',
        'camdx_other_business_activities',
        'camdx_patent_business_input_en',
        'camdx_patent_business_input_kh',
        'single_id',
        'type_of_company',
        'parent_id',
        'deleted_at',
        'holiday_type',
        'company_origin',
        'is_upload_excel',
        'excel_status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_4',
        'level_status',
        'approved_at',
        'approved_by',
        'declined_at',
        'declined_by',
        'is_complete_upload',
        'longtitude',
        'latitude',
        'export_excel_date',
        'export_excel_by',
        'operation_status',
        'request_survey_name',
        'request_survey_position',
        'request_survey_phone',
        'visai',
        'close_operation_date',
        'close_operation_reasons',
        'permanent_close_audit_by',
        'permanent_close_audit_date',
        'permanent_close_audit_officer',
        'permanent_close_audit_inform_name',
        'permanent_close_audit_inform_position',
        'permanent_close_audit_inform_phone',
        'permanent_close_operation_date',
        'permanent_close_operation_reasons',
        'close_audit_officer',
        'business_special_place',
        'head_business_special_place',
        'camdx_register_number',
        'first_business_act',
        'set_operation_status_by',
        'is_allow_print_book',
        'close_operation_system_date',
        'special_economy',
        'is_head_office',
        'is_branch',
        'branch_approved_number',
        'business_house_no',
        'business_street',
        'business_group',
        'business_village',
        'business_commune',
        'business_district',
        'business_province',
        'company_sub_type',
        'patent_special_place',
        'special_economy_zone',
        'close_operation_date_by_admin',
        'permanent_close_operation_date_by_admin',
        'csic_1',
        'csic_2',
        'csic_3',
        'csic_4',
        'csic_5',
    ];

    protected static $type_company = [
        1 => 'រោងចក្រ',
        2 => 'សណ្ឋាគារ',
        3 => 'ភោជនីយដ្ឋាន',
        18 => 'ផ្ទះសំណាក់',
        4 => 'ធនាគារ',
        5 => 'គ្រឹះស្ថានមីក្រូហិរញ្ញវត្ថុ',
        6 => 'ក្រុមហ៊ុន',
        7 => 'គ្រឹះស្ថានសិក្សា',
        8 => 'សិប្បកម្ម',
        9 => 'សហគ្រាស',
        10 => 'អង្គការ',
        11 => 'សមាគម',
        12 => 'ការិយាល័យតំណាង',
        13 => 'វិទ្យាស្ថាន',
        14 => 'មជ្ឈមណ្ឌល',
        15 => 'សាលា',
        16 => 'គ្លីនិក',
        17 => 'មន្ទីរពេទ្យ',
        18 => 'សួនកម្សាន្ត',
    ];

    protected static $article_of_company_kh_en = [
        '1' => 'ក្រុមហ៊ុនឯកជនទទួលខុសត្រូវមានកម្រិត | Private Limited Company',
        '2' => 'ក្រុមហ៊ុនមហាជនទទួលខុសត្រូវមានកម្រិត | Public Limited Company',
        '3' => 'សាខាក្រុមហ៊ុនបរទេស | Foreign Branch Office',
        '4' => 'ការិយាល័យតំណាងពាណិជ្ជកម្ម | Commercial Representative Office',
        '5' => 'សហគ្រាសឯកបុគ្គល | Sole Proprietorship',
        '14' => 'សហគ្រាសឯកបុគ្គលទទួលខុសត្រូវមានកម្រិត | Single Member Private Limited Company',
        '6' => 'ក្រុមហ៊ុនសហកម្មសិទ្ធិទូទៅ | General Partnership Company',
        '7' => 'ក្រុមហ៊ុនសហកម្មសិទ្ធិមានកម្រិត | Limited Partnership Company',
        '8' => 'គ្រឹះស្ថានសាធារណៈ | Public Institution',
        '9' => 'ក្រុមហ៊ុនរដ្ឋ | State Enterprise',
        '10' => 'ក្រុមហ៊ុនចម្រុះ | Joint Venture Company',
        '11' => 'អង្គការមិនមែនរដ្ឋាភិបាល | Non Governmental Organization',
        '12' => 'សមាគម | Association',
        '13' => 'ផ្សេងៗ | Others',
    ];
    protected static $article_of_company_kh = [
        '1' => 'ក្រុមហ៊ុនឯកជនទទួលខុសត្រូវមានកម្រិត',
        '2' => 'ក្រុមហ៊ុនមហាជនទទួលខុសត្រូវមានកម្រិត',
        '3' => 'សាខាក្រុមហ៊ុនបរទេស',
        '4' => 'ការិយាល័យតំណាងពាណិជ្ជកម្ម',
        '5' => 'សហគ្រាសឯកបុគ្គល',
        '14' => 'សហគ្រាសឯកបុគ្គលទទួលខុសត្រូវមានកម្រិត',
        '6' => 'ក្រុមហ៊ុនសហកម្មសិទ្ធិទូទៅ',
        '7' => 'ក្រុមហ៊ុនសហកម្មសិទ្ធិមានកម្រិត',
        '8' => 'គ្រឹះស្ថានសាធារណៈ',
        '9' => 'ក្រុមហ៊ុនរដ្ឋ',
        '10' => 'ក្រុមហ៊ុនចម្រុះ',
        '11' => 'អង្គការមិនមែនរដ្ឋាភិបាល',
        '12' => 'សមាគម',
        '13' => 'ផ្សេងៗ',
    ];
    protected static $business_activity_abbreviated = [
        1 => 'LE',
        2 => 'LC',
        3 => 'LZ',
        4 => 'LH',
        5 => 'LP',
        6 => 'LA',
        7 => 'LV',
        8 => 'LF',
        9 => 'LR',
        10 => 'LO',
        11 => 'MH',
        12 => 'MF',
        13 => 'MR',
        14 => 'MO',
        15 => ''
    ];

    protected static $business_activity = [
        18 => 'កាត់ដេរ',
        19 => 'វាយនភណ្ឌ',
        20 => 'ស្បែកជើង',
        21 => 'ផលិតផលធ្វើដំណើរនិងកាបូប',
        1 => 'ការនាំចេញ',
        2 => 'អាជីវកម្មកាសុីណូ',
        3 => 'តំបន់សេដ្ឋកិច្ចពិសេស',
        // 16 => 'ការអប់រំ',
        4 => 'រមណីយដ្ឋាន និងសណ្ឋាគារកម្រិតចាប់ពីផ្កាយបីឡើង',
        5 => 'ទីភ្នាក់ងារជ្រើសរើសឯកជន',
        6 => 'ក្រុមហ៊ុនអាកាសចរណ៍',
        7 => 'ក្រុមហ៊ុននាវាចរណ៍',
        8 => 'ស្នាក់ការកណ្ដាលស្ថាប័នហិរញ្ញវត្ថុ',
        9 => 'ស្នាក់ការកណ្ដាលក្រុមហ៊ុនអភិវឌ្ឍន៍អចលនវត្ថុ',
        10 => 'អង្គការសង្គមសុីវិល',
        17 => 'រោងចក្រ សហគ្រាសដែលមានកម្មករនិយោជិតសរុបក្រោម ១០១នាក់ ក្រៅពីសកម្មភាពសេដ្ឋកិច្ចខាងលើ',
        11 => 'រមណីយដ្ឋាន និងសណ្ឋាគារកម្រិតក្រោមផ្កាយបី',
        12 => 'សាខាស្ថាប័នហិរញ្ញវត្ថុ',
        13 => 'សាខាក្រុមហ៊ុនអភិវឌ្ឍន៍អចលនវត្ថុ',
        14 => 'សាខាអង្គការសង្គមសុីវិល',
        15 => 'ផ្សេងៗ'
    ];

    protected static $visai_kh_en = [
        '' => '',
        1 => 'កាត់ដេរ | G',
        2 => 'ដេរស្បែកជើង | FW',
        3 => 'បោះពុម្ពលើសម្លៀកបំពាក់ | PRI',
        4 => 'ប៉ាក់លើសម្លៀកបំពាក់ | EMB',
        5 => 'អំបោះ | YAR',
        6 => 'ផលិតផលធ្វើដំណើរ និងកាបូប | TGB',
        7 => 'តម្បាញ | KNI',
        8 => 'សណ្ឋាគារ | H',
        9 => 'ភ្នាក់ងារទេសចរណ៍ | TTA',
        10 => 'ផ្ទះសំណាក់ | GH',
        11 => 'ភោជនីយដ្ឋាន,អាហារដ្ឋាន | R',
        12 => 'សេវាកម្សាន្ត | EN',
        13 => 'ឡឥដ្ឋ | B',
        14 => 'សំណង់ | C',
        15 => 'បរិក្ខារពេទ្យ | ME',
        16 => 'អេឡិចត្រូនិច | ELE',
        17 => 'កសិកម្ម | Agri',
        18 => 'នេសាទ | Fish',
        19 => 'អាហារ | FO',
        20 => 'សន្តិសុខ | S',
        21 => 'ហិរញ្ញវត្ថុ | FA',
        22 => 'លក់ដុំ និងលក់រាយ | WG',
        23 => 'ដឹកជញ្ជូន សន្និធីស្តុកនិងគមនាគមន៍ | TSC',
        24 => 'អចលនទ្រព្យ | RE',
        25 => 'អគ្គិសនី ឧស្ម័ននិងទឹក | EGW',
        26 => 'អប់រំ | E',
        28 => 'បោកគក់ | LAU',
        29 => 'ផលិតកម្មក្រដាស និងផលិតផលធ្វើពីក្រដាស | MP',
        30 => 'រោងចក្រផ្គុំ ដំឡើងកង់ | BICK',
        31 => 'រោងចក្រផលិតផលរថយន្ត | AUT',
        32 => 'រោងចក្រ កែឆ្នៃផលិតផលជ័រ និងគ្រឿងផ្លាស្ទិច | RP',
        33 => 'សេវាសុខភាព គ្លីនិក មន្ទីរពេទ្យ | HE',
        34 => 'អង្គការ | ORG',
        35 => 'សមាគម | ASS',
        36 => 'ការិយាល័យតំណាង | REP',
        37 => 'រោងចក្រផ្សេងៗ | OF',
        38 => 'ផលិតកម្មផលិតគ្រឿងអគ្គិសនី | EC',
        39 => 'សណ្ឋាគាររីសត | RS',
        40 => 'ការធានារ៉ាប់រង | ISR',
        27 => 'ផ្សេងៗ | O',
    ];

    protected static $article_of_company_en = [
        '1' => 'Private Limited Company',
        '2' => 'Public Limited Company',
        '3' => 'Foreign Branch Office',
        '4' => 'Commercial Representative Office',
        '5' => 'Sole Proprietorship',
        '14' => 'Single Member Private Limited Company',
        '6' => 'General Partnership Company',
        '7' => 'Limited Partnership Company',
        '8' => 'Public Institution',
        '9' => 'State Enterprise',
        '10' => 'Joint Venture Company',
        '11' => 'Non Governmental Organization',
        '12' => 'Association',
        '15' => 'Individual',
        '13' => 'Others',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'code',
                'company_name_khmer',
                'company_name_latin',
                'house_no',
                'street',
                'group',
                'village',
                'commune',
                'district',
                'province',
                'created_by',
                'updated_by',
                'company_tin',
                'business_activity',
                'company_register_number',
                'branch_id',
                'user_id',
                'telephone',
                'owner_name',
                'owner_nationality',
                'director_name',
                'director_nationality',
                'main_business_activity',
                'main_product',
                'article_of_company',
                'registration_date',
                'business_activity_input',
                'owner_email',
                'owner_phone',
                'director_email',
                'director_phone',
                'hr_phone_1',
                'hr_phone_2',
                'hr_email_1',
                'hr_email_2',
                'secretary_name',
                'owner_gender',
                'director_gender',
                'owner_khmername',
                'director_khmername',
                'owner_id_number',
                'company_phone_number',
                'company_email',
                'provincial_control',
                'total_staff',
                'total_staff_female',
                'is_factory',
                'company_name_khmer_type',
                'is_updated',
                'nssf_id',
                'nssf_secondary_id',
                'nssf_company_id',
                'hr_name_kh',
                'hr_name_en',
                'director_id_number',
                'head_phone',
                'head_email',
                'head_house_no',
                'head_street',
                'head_group',
                'head_village',
                'head_commune',
                'head_district',
                'head_province',
                'head_phone_number',
                'head_email',
                'working_durations',
                'main_business_activity_2',
                'main_business_activity_3',
                'main_business_activity_4',
                'sme_type',
                'business_objective_input',
                'business_objective_input_en',
                'is_child_company',
                'is_branch_company',
                'camdx_business_objective',
                'camdx_main_business_activities',
                'camdx_other_business_activities',
                'camdx_patent_business_input_en',
                'camdx_patent_business_input_kh',
                'single_id',
                'type_of_company',
                'deleted_at',
                'parent_id',
                'holiday_type',
                'company_origin',
                'is_upload_excel',
                'excel_status',
                'level_1',
                'level_2',
                'level_3',
                'level_4',
                'level_4',
                'level_status',
                'approved_at',
                'approved_by',
                'declined_at',
                'declined_by',
                'is_complete_upload',
                'longtitude',
                'latitude',
                'export_excel_date',
                'export_excel_by',
                'operation_status',
                'request_survey_name',
                'request_survey_position',
                'request_survey_phone',
                'visai',
                'close_operation_date',
                'close_operation_reasons',
                'permanent_close_audit_by',
                'permanent_close_audit_date',
                'permanent_close_audit_officer',
                'permanent_close_audit_inform_name',
                'permanent_close_audit_inform_position',
                'permanent_close_audit_inform_phone',
                'permanent_close_operation_date',
                'permanent_close_operation_reasons',
                'close_audit_officer',
                'business_special_place',
                'head_business_special_place',
                'camdx_register_number',
                'first_business_act',
                'set_operation_status_by',
                'is_allow_print_book',
                'close_operation_system_date',
                'special_economy',
                'is_head_office',
                'is_branch',
                'branch_approved_number',
                'business_house_no',
                'business_street',
                'business_group',
                'business_village',
                'business_commune',
                'business_district',
                'business_province',
                'company_sub_type',
                'patent_special_place',
                'special_economy_zone',
                'close_operation_date_by_admin',
                'permanent_close_operation_date_by_admin',
                'csic_1',
                'csic_2',
                'csic_3',
                'csic_4',
                'csic_5',
            ]);
    }

    public static function getTypeOfCompany()
    {
        return self::$type_company;
    }

    public static function getArticleOfCompanyKh(){
        return self::$article_of_company_kh;
    }

    public static function getArticleOfCompanyKhEn(){
        return self::$article_of_company_kh_en;
    }
    public static function getBusinessActivityAbbreviated(){
        return self::$business_activity_abbreviated;
    }
    public static function getBusinessActivity(){
        return self::$business_activity;
    }
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function bio()
    {
        return $this->hasMany('App\Models\Bio\Bio', 'company_id');
    }

    public function visa()
    {
        return $this->hasMany('App\Models\Bio\WorkingLogRequest', 'company_id');
    }

    public function reprint()
    {
        return $this->hasMany('App\Models\Bio\BioRequestReprint', 'company_id');
    }

    public function physical()
    {
        return $this->hasMany('App\Models\Physical\Physical', 'company_id');
    }

    public function physical_spot()
    {
        return $this->hasMany('App\Models\Physical\PhysicalSpot', 'company_id');
    }

    public function staffmovement()
    {
        return $this->hasMany('App\Models\StaffMovement\StaffMovement', 'company_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Children\RequestChildren', 'company_id');
    }

    public function vote()
    {
        return $this->hasMany('App\Models\Vote\Vote', 'company_id');
    }

    public function request_ot()
    {
        return $this->hasMany('App\Models\Inspection\RequestOT', 'company_id');
    }

    public function request_ir()
    {
        return $this->hasMany('App\Models\Inspection\RequestIR', 'company_id');
    }

    public function request_book_payroll()
    {
        return $this->hasMany('App\Models\Inspection\RequestBookPayroll', 'company_id');
    }

    public function suspension()
    {
        return $this->hasMany('App\Models\Inspection\Suspension', 'company_id');
    }

    public function apprenticeship()
    {
        return $this->hasMany('App\Models\Apprenticeship\Apprenticeship', 'company_id');
    }

    public function registration()
    {
        return $this->hasMany('App\Models\Registration\Registration', 'company_id');
    }

    public function company()
    {
        return $this->hasOne('App\Models\Company\Company', 'created_by');
    }

    public function worker_excel()
    {
        return $this->hasMany('App\Models\Company\WorkerExcel', 'company_id');
    }

    public function upload_excel()
    {
        return $this->hasMany('App\Models\Company\UploadExcel', 'company_id');
    }

    public function company_detail()
    {
        return $this->hasOne('App\Models\Company\CompanyDetail', 'company_id');
    }

    public function worker_excel_list_with_bio()
    {
        return $this->hasManyThrough('App\Models\Company\WorkerExcel', 'App\Models\Company\UploadExcel', 'company_id', 'request_id', 'id', 'id')->where('excel_status', 1)->whereDoesntHave('bio_approved');
    }

    public static function getTypeCompany($id)
    {
        return Arr::last(self::getTypeOfCompany(), function ($value, $key) use ($id) {
            return $key == $id;
        });
    }

    public function main_business_activities()
    {
        return $this->belongsTo('App\Models\StaffMovement\BusinessActivity', 'main_business_activity', 'code');
    }

    public function owner_nationalities()
    {
        return $this->belongsTo('App\Models\Bio\Nationality', 'owner_nationality');
    }

    public function director_nationalities()
    {
        return $this->belongsTo('App\Models\Bio\Nationality', 'director_nationality');
    }

    public function worker_excel_list()
    {
        return $this->hasManyThrough('App\Models\Company\WorkerExcel', 'App\Models\Company\UploadExcel', 'company_id', 'request_id', 'id', 'id')->where('excel_status', 1);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by', 'id');
    }
    public function patent()
    {
        return $this->hasMany('App\Models\Registration\Patent', 'company_id');
    }

    public function update_company()
    {
        return $this->hasMany('App\Models\Inspection\UpdateCompany', 'company_id');
    }

    public function csic5_detail(){
        return $this->belongsTo('App\Models\User\CSIC5', 'csic_5', 'code');
    }

    public static function getVisaiKHEN(){
        return self::$visai_kh_en;
    }

    public static function getArticleOfCompanyEn(){
        return self::$article_of_company_en;
    }

    public function sop1Detail()
    {
        return $this->hasMany('App\Models\Covid\SOP1Detail', 'company_id');
    }

    public function worker_test_covid_detail(){
        return $this->hasMany('App\Models\Covid\WorkerTestCovidDetail', 'company_id');
    }

    public static function getBusinessActivityCompany($id){
        return Arr::last(self::getBusinessActivity(), function ($value, $key) use($id) {return $key == $id;});
    }

    public function safety(){
        return $this->hasMany('App\Models\Covid\WorkAccident', 'company_id');
    }
}
