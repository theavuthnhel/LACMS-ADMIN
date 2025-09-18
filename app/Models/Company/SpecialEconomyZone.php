<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SpecialEconomyZone extends Model
{
    use LogsActivity, SoftDeletes;

    protected $table = "special_economy_zone";

    protected $primaryKey = "id";

    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'name_kh',
        'name_en',
        'created_by',
        'updated_by'
    ];

    protected static $logAttributes = [
        'name_kh',
        'name_en',
        'created_by',
        'updated_by'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->logAttributes);
    }
}
