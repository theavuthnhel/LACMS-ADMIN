<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CovidTool extends Model implements HasMedia
{
    use LogsActivity, InteractsWithMedia;

    protected $table = "covidtool";

	protected $primaryKey = "id";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'covidtool_name',
    	'covidtool_model',
        'created_by',
        'updated_by',
    ];

    protected static $logAttributes = [
    	'covidtool_name',
    	'covidtool_model',
        'created_by',
        'updated_by',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} CovidTool";
    }
}
