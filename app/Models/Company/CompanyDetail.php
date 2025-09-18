<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyDetail extends Model
{
    use LogsActivity, SoftDeletes;

	protected $table = "company_detail";

	protected $primaryKey = "id";
    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'company_id',
    	'doctor_khmer_name',
        'doctor_latin_name',
        'doctor_sex',
        'doctor_dob',
        'doctor_phone_number',
        'safety_khmer_name',
        'safety_latin_name',
        'safety_sex',
        'safety_dob',
        'safety_phone_number',
        'hr1_khmer_name',
        'hr1_latin_name',
        'hr1_sex',
        'hr1_dob',
        'hr1_phone_number',
        'hr2_khmer_name',
        'hr2_latin_name',
        'hr2_sex',
        'hr2_dob',
        'hr2_phone_number',
        'vote1_khmer_name',
        'vote1_latin_name',
        'vote1_sex',
        'vote1_dob',
        'vote1_phone_number',
        'vote2_khmer_name',
        'vote2_latin_name',
        'vote2_sex',
        'vote2_dob',
        'vote2_phone_number',
        'vote3_khmer_name',
        'vote3_latin_name',
        'vote3_sex',
        'vote3_dob',
        'vote3_phone_number',
        'aid_khmer_name',
        'aid_latin_name',
        'aid_sex',
        'aid_dob',
        'aid_phone_number',
        'representative_khmer_name',
        'representative_latin_name',
        'representative_sex',
        'representative_dob',
        'representative_phone_number',
        'created_by',
        'updated_by'
     ];

     protected static $logAttributes = [
     	'company_id',
    	'doctor_khmer_name',
        'doctor_latin_name',
        'doctor_sex',
        'doctor_dob',
        'doctor_phone_number',
        'safety_khmer_name',
        'safety_latin_name',
        'safety_sex',
        'safety_dob',
        'safety_phone_number',
        'hr1_khmer_name',
        'hr1_latin_name',
        'hr1_sex',
        'hr1_dob',
        'hr1_phone_number',
        'hr2_khmer_name',
        'hr2_latin_name',
        'hr2_sex',
        'hr2_dob',
        'hr2_phone_number',
        'vote1_khmer_name',
        'vote1_latin_name',
        'vote1_sex',
        'vote1_dob',
        'vote1_phone_number',
        'vote2_khmer_name',
        'vote2_latin_name',
        'vote2_sex',
        'vote2_dob',
        'vote2_phone_number',
        'vote3_khmer_name',
        'vote3_latin_name',
        'vote3_sex',
        'vote3_dob',
        'vote3_phone_number',
        'created_by',
        'updated_by'
    ];

     public  function getActivitylogOptions(): LogOptions
     {
          return LogOptions::defaults()
            ->logOnly([
                'company_id',
                'doctor_khmer_name',
                'doctor_latin_name',
                'doctor_sex',
                'doctor_dob',
                'doctor_phone_number',
                'safety_khmer_name',
                'safety_latin_name',
                'safety_sex',
                'safety_dob',
                'safety_phone_number',
                'hr1_khmer_name',
                'hr1_latin_name',
                'hr1_sex',
                'hr1_dob',
                'hr1_phone_number',
                'hr2_khmer_name',
                'hr2_latin_name',
                'hr2_sex',
                'hr2_dob',
                'hr2_phone_number',
                'vote1_khmer_name',
                'vote1_latin_name',
                'vote1_sex',
                'vote1_dob',
                'vote1_phone_number',
                'vote2_khmer_name',
                'vote2_latin_name',
                'vote2_sex',
                'vote2_dob',
                'vote2_phone_number',
                'vote3_khmer_name',
                'vote3_latin_name',
                'vote3_sex',
                'vote3_dob',
                'vote3_phone_number',
                'created_by',
                'updated_by'
            ]);
     }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} CompanyDetail";
    }

    /*public function toArray()
    {
        $array = parent::toArray();
        $array['id'] =  encodeParam($this->id); // Encrypt the ID
        return $array;
    }*/
}
