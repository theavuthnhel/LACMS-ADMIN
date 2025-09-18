<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BioVerify extends Model
{
    protected $table = "bio_verify";

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'bio_id',
    	'comment',
    	'level',
        'created_by'
    ];

    protected static $logAttributes = [
    	'bio_id',
    	'comment',
    	'level',
        'created_by'
    ];

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }
}
