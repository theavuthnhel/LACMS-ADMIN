<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class WorkerIllnessItem extends Model
{
    use LogsActivity;

    protected $table = "worker_illness_item";

    protected $primaryKey = "id";

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'categories_id',
        'name_kh',
        'name_en',
        'created_by',
        'updated_by',
    ];

    protected static $logAttributes = [
        'categories_id',
        'name_kh',
        'name_en',
        'created_by',
        'updated_by',
    ];

    protected static $categories_type = [
        '1' => 'ក.ជំងឺឆ្លង',
        '2' => 'ខ.ជំងឺភ្នែក',
        '3' => 'គ.ជំងឺផ្លូវដង្ហើម',
        '4' => 'ឃ.ជំងឺប្រព័ន្ធរំលាយអាហារ',
        '5' => 'ង.ជំងឺសើរស្បែក',
        '6' => 'ច.ជំងឺប្រព័ន្ធបង្ហួរនោម ',
        '7' => 'ឆ.ជំងឺមិនឆ្លង',
        '8' => 'ជ.ជំងឺផ្សេងៗ',
        '9' => 'ឈ. រោគសញ្ញាទូទៅ'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public static function getCategoriesType()
    {
        return self::$categories_type;
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} WorkerIllnessItem";
    }
}
