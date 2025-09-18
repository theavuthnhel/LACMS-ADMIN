<?php

namespace App\Models\Apprenticeship;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;

class ApprenticeshipDetail extends Model implements HasMedia
{
	use InteractsWithMedia, LogsActivity;

    protected $table = "apprenticeship_detail";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'apprenticeship_id',
        'skill',
        'khmer_name',
        'latin_name',
        'gender',
        'dob',
        'pob',
        'pob_province',
        'pob_district',
        'pob_commune',
        'pob_village',
        'skill_in_khmer',
        'skill_in_english',
        'status',
        'grade',
        'testing_date',
        'testing_location',
        'id_number',
        'telephone',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'telephone_2',
        'certificate_book_code',
        'finished_date',
    ];

    protected static $logAttributes = [
        'skill',
        'khmer_name',
        'latin_name',
        'gender',
        'dob',
        'pob',
        'pob_province',
        'pob_district',
        'pob_commune',
        'pob_village',
        'skill_in_khmer',
        'skill_in_english',
        'status',
        'grade',
        'testing_date',
        'testing_location',
        'id_number',
        'telephone',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'telephone_2',
        'certificate_book_code',
        'finished_date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function apprenticeship(){
        return $this->belongsTo('App\Models\Apprenticeship\Apprenticeship', 'apprenticeship_id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Apprenticeship Detail";
    }
}
