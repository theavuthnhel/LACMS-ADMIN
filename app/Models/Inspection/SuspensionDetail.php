<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuspensionDetail extends Model
{

    use SoftDeletes;

	protected $table = "suspension_detail";

    protected $primaryKey = "id";

    protected $dates = ['deleted_at'];


    protected $fillable = [
    	'suspension_id',
        'worker_id'
    ];

    protected static $logAttributes = [
    	'suspension_id',
        'worker_id'
    ];

    public function suspension()
    {
        return $this->belongsTo('App\Models\Inspection\Suspension', 'suspension_id');
    }

    public function worker()
    {
        return $this->belongsTo('App\Models\Company\WorkerExcel', 'worker_id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} SuspensionDetail";
    }
}
