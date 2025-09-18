<?php

namespace App\Models\Physical;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;


class PCRTEST extends Model implements HasMedia
{
	use InteractsWithMedia ,LogsActivity, SoftDeletes, Notifiable;

	protected $table = "physical_pcr_test";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'health_facility',
        'testing_date',
    	'reasons_for_testing',
    	'covid_case_name',
    	'type_of_contact',
    	'reasons_for_testing_others',
    	'patient_name',
    	'patient_name_khmer',
    	'patient_id',
    	'gender',
    	'dob',
    	'nationality',
    	'telephone',
    	'house_no',
    	'street',
    	'village',
    	'commune',
    	'district',
    	'province',
    	'clinical_symptom',
    	'date_of_onset',
    	'history_of_covid',
    	'history_of_covid_date',
    	'co_mobidity',
    	'is_co_mobidity_other_name',
    	'country_name',
    	'date_of_arrival',
    	'passport_no',
    	'seat_no',
    	'country_name_14_days',
    	'place_of_collection',
    	'date_of_collection',
    	'type_of_specimen',
    	'type_of_specimen_other_name',
    	'laboratory',
    	'laboratory_other_name',
    	'no_of_sample',
    	'requested_by',
    	'requested_telephone',
    	'collected_by',
    	'collected_telephone',
        'code',
    	'status',
    	'payment_status',
        'certificate_code',
        'ocwc_number',
    	'created_by',
    	'updated_by',
        'payment_date',
        'testing_results',
        'test_date',
        'test_time',
        'email',
        'time_of_collection',
        'approved_by',
        'approved_at',
        'print_by',
        'print_at',
        'payment_type',
        'bank_transaction_id',
        'creditor_id',
    ];

    protected static $logAttributes = [
    	'health_facility',
        'testing_date',
    	'reasons_for_testing',
    	'covid_case_name',
    	'type_of_contact',
    	'reasons_for_testing_others',
    	'patient_name',
    	'patient_name_khmer',
    	'patient_id',
    	'gender',
    	'dob',
    	'nationality',
    	'telephone',
    	'house_no',
    	'street',
    	'village',
    	'commune',
    	'district',
    	'province',
    	'clinical_symptom',
    	'date_of_onset',
    	'history_of_covid',
    	'history_of_covid_date',
    	'co_mobidity',
    	'is_co_mobidity_other_name',
    	'country_name',
    	'date_of_arrival',
    	'passport_no',
    	'seat_no',
    	'country_name_14_days',
    	'place_of_collection',
    	'date_of_collection',
    	'type_of_specimen',
    	'type_of_specimen_other_name',
    	'laboratory',
    	'laboratory_other_name',
    	'no_of_sample',
    	'requested_by',
    	'requested_telephone',
    	'collected_by',
    	'collected_telephone',
        'code',
    	'status',
    	'payment_status',
        'certificate_code',
        'ocwc_number',
    	'created_by',
    	'updated_by',
        'payment_date',
        'testing_results',
        'test_date',
        'test_time',
        'email',
        'time_of_collection',
        'approved_by',
        'approved_at',
        'print_by',
        'print_at',
        'payment_type',
        'bank_transaction_id',
        'creditor_id',
    ];
    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
           ->logOnly(self::$logAttributes);
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

    public function printBy(){
        return $this->belongsTo('App\Models\User\User', 'print_by');
    }

    protected static $reasons_for_testing = [
        1 => 'សង្ស័យ - Suspect',
        2 => 'រលាកសួត - Pneumoia',
        3 => 'បុក្គលិកពេទ្យ - HCW',
        4 => 'ពលករ - Migrants',
        5 => 'ប៉ះពាល់ជាមួយអ្នកកើតជំងឺកូវីដ១៩ - Contact with COVID cases',
        6 => 'តាមដាន - Follow-up',
        7 => 'តាមដានអ្នកជំងៃកូវីដ - Follow-up COVID patient',
        8 => 'ផ្សេងទៀត - Other',
    ];

    protected static $type_of_contact = [
        1 => 'ផ្ទាល់ - Direct',
        2 => 'មិនផ្ទាល់ - Indirect',
    ];

    protected static $clinical_symptom = [
        1 => 'គ្រុនក្តៅ - Fever',
        2 => 'ក្អក - Cough',
        3 => 'ហៀរសំបោរ - Runny Nose',
        4 => 'ឈឺបំពង់ក - Sore Throat',
        5 => 'ពិបាកដកដង្ហើម - Difficult Breathing',
        6 => 'គ្មាន - None',
    ];

    protected static $co_mobidity = [
        1 => 'លើសឈាម - Hypertension',
        2 => 'ទឹកនោមផ្អែម - Diabetes',
        3 => 'ជំងឺបេះដូង - Cardiopath',
        4 => 'ខ្សោយតម្រងនោម - CKD',
        5 => 'ធាត់ - Obesity',
        6 => 'មានផ្ទៃពោះ - Pregnant',
        7 => 'គ្មាន - None',
    ];

    protected static $vaccination_status = [
        1 => 'ដូសទី១ - 1st Dose',
        2 => 'ដូសទី២ - 2nd Dose',
        3 => 'ដូសទី៣ - 3rd Dose',
        4 => 'ដូសទី៤ - 4th Dose',
        5 => 'ដូសទី៥ - 5th Dose',
        6 => 'ដូសទី៦ - 6th Dose',
        7 => 'ដូសទី៧ - 7th Dose',
        8 => 'ដូសទី៨ - 8th Dose',
        9 => 'ដូសទី៩ - 9th Dose',
        10 => 'ដូសទី១០ - 10th Dose',
    ];

    protected static $vaccination_type = [
        1 => 'Sinopharm',
        2 => 'Sinovac',
        3 => 'AstraZeneca',
        4 => 'Johnson & Johnson',
        5 => 'Modernas',
        6 => 'Pfizer',
    ];

    protected static $type_of_specimen = [
        1 => 'ច្រមុះ - Nasopharyngeal',
        2 => 'បំពង់ក - Oropharyngeal',
    ];

    protected static $laboratory = [
        1 => 'មន្ទីរពិសោធន៍ពេទ្យការងារ - Occupational Safety and Health Laboratory',
    ];

    protected static $no_of_sample = [
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => '10',
        11 => '11',
        12 => '12',
        13 => '13',
        14 => '14',
        15 => '15',
    ];

    protected static $testing_results = [
        1 => 'អវិជ្ជមាន - Negative',
        2 => 'វិជ្ជមាន - Positive',
    ];
    public static function getReasonsForTesting(){
        return self::$reasons_for_testing;
    }


    public static function getTypeOfContact(){
        return self::$type_of_contact;
    }

    public static function getClinicSymptom(){
        return self::$clinical_symptom;
    }

    public static function getCoMobidity(){
        return self::$co_mobidity;
    }

    public static function getVaccinationStatus(){
        return self::$vaccination_status;
    }

    public static function getVaccinationType(){
        return self::$vaccination_type;
    }

    public static function getTypeOfSpecimen(){
        return self::$type_of_specimen;
    }

    public static function getLaboratory(){
        return self::$laboratory;
    }

    public static function getNoOfSample(){
        return self::$no_of_sample;
    }

    public static function getTestingResults(){
        return self::$testing_results;
    }

    public function vaccination_status_detail(){
        return $this->hasMany('App\Models\Physical\VaccinationStatus', 'pcr_id');
    }

    public function nationalities(){
        return $this->belongsTo('App\Models\Bio\Nationality', 'nationality');
    }

    public function villages(){
        return $this->belongsTo('App\Models\Bio\Village', 'village', 'vil_id');
    }
    public function communes(){
        return $this->belongsTo('App\Models\Bio\Commune', 'commune', 'com_id');
    }
    public function districts(){
        return $this->belongsTo('App\Models\Bio\District', 'district', 'dis_id');
    }
    public function provinces(){
        return $this->belongsTo('App\Models\Bio\Province', 'province');
    }

    public function creditor(){
        return $this->belongsTo('App\Models\Physical\Creditor', 'creditor_id');
    }

    // public function scopePartner($query){
    //     if(\Auth::user()->is_partner == 1)
    //         return $query->where('registered_partner_id', \Auth::user()->partner_id);
    // }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} PCR TEST";
    }
}
