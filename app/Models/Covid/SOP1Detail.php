<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SOP1Detail extends Model implements HasMedia
{
	use LogsActivity, SoftDeletes, InteractsWithMedia;

	protected $table = "sop_1_detail";

	protected $primaryKey = "id";

	protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
        'name',
        'gender',
        'position',
        'position_in_document',

    ];

    protected static $logAttributes = [
    	'company_id',
        'name',
        'gender',
        'position',
        'position_in_document',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }


    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} SOP1";
    }
}
