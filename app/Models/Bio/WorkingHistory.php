<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class WorkingHistory extends Model implements HasMedia
{
	use InteractsWithMedia, LogsActivity, SoftDeletes;

    protected $table = "working_history";

    protected $dates = ['deleted_at'];

    protected $fillable = [
    	"bio_id",
    	"date_in",
    	"date_out",
    	"company",
    	"position",
    	"salary",
    	"created_by",
    	"updated_by",
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
        'business_activity',
        'company_register_number',
        'last_salary',
        'working_history_type',
        'stop_working_reason',
        'last_position',
        'salary_in_type',
        'working_hour',
        'staff_type',
        'emergency_name',
        'emergency_phone',
        'emergency_phone_2',
        'relationship',
        'is_first',
        'osh_number',
        'is_out',
        'working_role',
        'last_working_role',
        'deleted_at',
    ];



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                "bio_id",
                "date_in",
                "date_out",
                "company",
                "position",
                "salary",
                "created_by",
                "updated_by",
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
                'business_activity',
                'company_register_number',
                'last_salary',
                'working_history_type',
                'stop_working_reason',
                'last_position',
                'salary_in_type',
                'working_hour',
                'staff_type',
                'emergency_name',
                'emergency_phone',
                'emergency_phone_2',
                'relationship',
                'is_first',
                'osh_number',
                'is_out',
                'working_role',
                'last_working_role',
                'deleted_at',
            ]);
    }
    public function createdBy(){
    	return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function companies()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company');
    }

    public function bio()
    {
        return $this->belongsTo('App\Models\Bio\Bio', 'bio_id');
    }

    public function workingLogRequest()
    {
        return $this->hasOne('App\Models\Bio\WorkingLogRequest');
    }

    public function getFullAddressAttribute()
    {
        return ($this->business_house_no != "" ? 'ផ្ទះលេខ '. $this->business_house_no : ""). ($this->business_street != "" ? ' ផ្លូវ '. $this->business_street : ""). ($this->business_group != "" ? ' ក្រុម '. $this->business_group : "") . $this->company_business_address();
    }

    protected function company_business_address(){
        $province = Province::where('pro_id', $this->business_province)->first();
        $district = $this->business_district != "" ? District::where('province_id', $this->business_province)->where('dis_id', $this->business_district)->first() : "";
        $commune = $this->business_commune != "" ? Commune::where('district_id', $this->business_district)->where('com_id', $this->business_commune)->first() : "";
        $village = $this->business_village != "" ? Village::where('commune_id', $this->business_commune)->where('vil_id', $this->business_village)->first() : "";
        $output = "";
        if($village){
            $output .= " ភូមិ " . $village->vil_khname;
        }
        if($commune){
            $output .= " ឃុំ/សង្កាត់ " . $commune->com_khname;
        }
        if($district){
            $output .= " ស្រុក/ខណ្ឌ " . $district->dis_khname;
        }
        if($province){
            $output .= " ខេត្ត/រាជធានី " . $province->pro_khname;
        }
        return $output;
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Working History";
    }
}
