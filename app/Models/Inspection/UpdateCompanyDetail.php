<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\LogOptions;

class UpdateCompanyDetail extends Model implements HasMedia
{
    use InteractsWithMedia, LogsActivity, SoftDeletes;

    protected $table = "update_company_detail";

    protected $primaryKey = "id";

    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    const CHANGE_COMPANY_NAME = 1;
    const CHANGE_OWNER = 2;
    const CHANGE_DIRECTOR = 3;
    const CHANGE_SHARE = 4;
    const CHANGE_ADDRESS = 5;
    const CHANGE_ARTICLE= 6;
    const CHANGE_ACTIVITIES = 7;

    protected $fillable = [
        'update_company_id',
        'type',
        'record_type',
        //name
        'company_name_khmer',
        'company_name_latin',
        //address
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        //owner
        'is_use_owner_name',
        'is_use_company_name',
        'owner_name',
        'owner_khmername',
        'owner_nationality',
        'owner_gender',
        'owner_id_number',
        'representative_name_khmer',
        'representative_name_latin',
        //director
        'director_name',
        'director_khmername',
        'director_nationality',
        'director_gender',
        'director_id_number',
        'longtitude', 
        'latitude',
        'special_economy_zone',
        //article_of_company
        'article_of_company',
        //business_activity
        'business_activity',
    ];

    protected static $logAttributes = [ 
        'update_company_id',
        'type',
        'record_type',
        //name
        'company_name_khmer',
        'company_name_latin',
        //address
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        //owner
        'is_use_owner_name',
        'is_use_company_name',
        'owner_name',
        'owner_khmername',
        'owner_nationality',
        'owner_gender',
        'owner_id_number',
        'representative_name_khmer',
        'representative_name_latin',
        //director
        'director_name',
        'director_khmername',
        'director_nationality',
        'director_gender',
        'director_id_number',
        'longtitude', 
        'latitude',
        'special_economy_zone',
        //article_of_company
        'article_of_company',
        //business_activity
        'business_activity',
    ];

    public function owner_nationalities()
    {
        return $this->belongsTo('App\Models\Bio\Nationality', 'owner_nationality');
    }

    public function director_nationalities()
    {
        return $this->belongsTo('App\Models\Bio\Nationality', 'director_nationality');
    }

    public function business_special_economy_zone()
    {
        return $this->belongsTo('App\Models\Company\SpecialEconomyZone', 'special_economy_zone');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Update Company Detail";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable)
            ->logOnlyDirty()
            ->useLogName('update_company_detail');
    }

}
