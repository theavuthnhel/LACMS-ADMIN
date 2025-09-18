<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Model;

class BioVoid extends Model
{
    protected $table = "bio_void";

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'bio_id',
    	'reason',
        'created_by'
    ];

    protected static $logAttributes = [
    	'bio_id',
    	'reason',
        'created_by'
    ];

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }
}
