<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia};

class WorkAccident extends Model implements HasMedia
{
    use LogsActivity, InteractsWithMedia, SoftDeletes;


    protected $table = "work_accident";

    protected $primaryKey = "id";

    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'company_id',
        'type',
        'p_330_medicine',
        'p_330_equipment',
        'first_aid',
        'first_aid_amount',
        'helper',
        'helper_amount',
        'amount_of_factory_same_clinic',
        'distance_over_1km',
        'not_over_staff',
        'total_staff',
        'total_staff_female',
        'name_of_clinic',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'clinic_phone_number',
        'clinic_distance_over_1km',
        'created_by',
        'updated_by',
        'status',
        'submitted_at',
        'for_month',
        'level_1',
        'level_2',
        'level_3',
        'level_status',
        'approved_by',
        'approved_at',
        'declined_by',
        'declined_at',
    ];

    protected static $logAttributes = [
        'company_id',
        'type',
        'p_330_medicine',
        'p_330_equipment',
        'first_aid',
        'first_aid_amount',
        'helper',
        'helper_amount',
        'amount_of_factory_same_clinic',
        'distance_over_1km',
        'not_over_staff',
        'total_staff',
        'total_staff_female',
        'name_of_clinic',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'clinic_phone_number',
        'clinic_distance_over_1km',
        'created_by',
        'updated_by',
        'status',
        'submitted_at',
        'for_month',
        'level_1',
        'level_2',
        'level_3',
        'level_status',
        'approved_by',
        'approved_at',
        'declined_by',
        'declined_at',
    ];

    protected static $type = [
        '1' => 'គិលានដ្ឋានសហគ្រាស',
        '2' => 'គិលានដ្ឋានរួម',
        '3' => 'មូលដ្ឋានសុខាភិបាលដៃគូ',
        '4' => 'បន្ទប់រុំរបួស',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public static function getType()
    {
        return self::$type;
    }

    public static function getTypeById($id)
    {
        return self::$type[$id] ?? null; // returns null if ID not found
    }


    public function doctor()
    {
        return $this->hasMany('App\Models\Covid\WorkAccidentDoctor', 'work_accident_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function verify()
    {
        return $this->hasMany('App\Models\Covid\SafetyVerify', 'request_id');
    }

    public function declined()
    {
        return $this->hasMany('App\Models\Covid\SafetyDecline', 'request_id');
    }

    public function void()
    {
        return $this->hasMany('App\Models\Covid\SafetyVoid', 'request_id');
    }

    public function apprvoedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'approved_by');
    }

    public function declinedBy()
    {
        return $this->belongsTo('App\Models\User\User', 'declined_by');
    }

    public function voidBy()
    {
        return $this->belongsTo('App\Models\User\User', 'void_by');
    }

    public function recordLock()
    {
        return $this->morphOne('App\RecordLock', 'lockable');
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
        return "{$eventName} WorkAccident";
    }
}
