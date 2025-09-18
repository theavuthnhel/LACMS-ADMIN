<?php

namespace App\Models\Children;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;

class RequestChildrenDetail extends Model implements HasMedia
{
	use InteractsWithMedia, LogsActivity;

	protected $table = "request_children_detail";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'request_children_id',
        'khmer_name',
        'latin_name',
        'gender',
        'nationality',
        'dob',
        'working_date',
        'position',
        'education',
        'working_hour_in_week',
        'holiday',
        'job_type',
        'guardian',
        'guardian_id_number',
        'phone_number',
        'house_no',
        'street',
        'group',
        'province',
        'district',
        'commune',
        'village',
        'bio_id',
        'physical_id',
        'workpermit_id',
        'relationship',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'request_children_id',
                'khmer_name',
                'latin_name',
                'gender',
                'nationality',
                'dob',
                'working_date',
                'position',
                'education',
                'working_hour_in_week',
                'holiday',
                'job_type',
                'guardian',
                'guardian_id_number',
                'phone_number',
                'house_no',
                'street',
                'group',
                'province',
                'district',
                'commune',
                'village',
                'bio_id',
                'physical_id',
                'workpermit_id',
                'relationship',
            ]);
    }
    public function children(){
    	return $this->belongsTo('App\Models\Children\RequestChildren', 'request_children_id');
    }

    public function bio(){
        return $this->belongsTo('App\Models\Bio\Bio', 'bio_id');
    }

    public function physical(){
        return $this->belongsTo('App\Models\Physical\Physical', 'physical_id');
    }

    public function nationalities(){
        return $this->belongsTo('App\Models\Bio\Nationality', 'nationality');
    }

    public function educations(){
        return $this->belongsTo('App\Models\Bio\Education', 'education');
    }



}
