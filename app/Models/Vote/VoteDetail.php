<?php

namespace App\Models\Vote;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Activitylog\LogOptions;

class VoteDetail extends Model implements HasMedia
{
	use InteractsWithMedia, LogsActivity, SoftDeletes;

	protected $table = "vote_detail";

	protected $primaryKey = "id";

	protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'vote_id',
        'vote_type',
        'vote_type_1',
    	'khmer_name',
    	'latin_name',
        'gender',
    	'dob',
    	'working_duration',
    	'duration_type',
    	'vote_amount',
        'workpermit_id',
        'phone_number',
    ];

    protected static $logAttributes = [
    	'vote_id',
        'vote_type',
        'vote_type_1',
    	'khmer_name',
    	'latin_name',
        'gender',
    	'dob',
    	'working_duration',
    	'duration_type',
    	'vote_amount',
        'workpermit_id',
        'phone_number',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} vote_detail";
    }
}
