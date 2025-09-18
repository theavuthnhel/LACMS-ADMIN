<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class ImportDecline extends Model
{
    protected $table = "import_decline";

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'company_id',
    	'reason',
        'created_by'
    ];

    protected static $logAttributes = [
    	'company_id',
    	'reason',
        'created_by'
    ];

    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }
}
