<?php

namespace App\Models\Physical;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;

class PhysicalPartner extends Model implements HasMedia
{
	use InteractsWithMedia, LogsActivity;

	protected $table = "physical_partner";

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'code',
    	'partner_name',
    	'partner_latin_name',
    	'partner_address',
    	'phone_1',
    	'phone_2',
    	'status',
    	'created_by',
    	'updated_by',
        'village',
        'commune',
        'district',
        'province',
    ];

    protected static $logAttributes = [
        'code',
    	'partner_name',
    	'partner_latin_name',
    	'partner_address',
    	'phone_1',
    	'phone_2',
    	'status',
    	'created_by',
    	'updated_by',
        'village',
        'commune',
        'district',
        'province',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'code',
                'partner_name',
                'partner_latin_name',
                'partner_address',
                'phone_1',
                'phone_2',
                'status',
                'created_by',
                'updated_by',
                'village',
                'commune',
                'district',
                'province',
            ]);
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function partners()
    {
        return $this->belongsTo('App\Models\Physical\PhysicalPartner', 'registered_partner_id');
    }

    public function scopePartner($query){
        if(\Auth::user()->is_partner == 1)
            return $query->where('registered_partner_id', \Auth::user()->partner_id);
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Physical Partner";
    }
}
