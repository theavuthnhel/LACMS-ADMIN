<?php

namespace App\Models\StaffMovement;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class StaffMovementDetail extends Model implements HasMedia
{
    use LogsActivity, InteractsWithMedia, SoftDeletes;

	protected $table = "staff_movement_detail";

    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'staff_movement_id',
        'bio_id',
        'remark',
        'name',
        'gender',
        'nationality',
        'dob',
        'workpermit_id',
        'salary',
        'salary_in_type',
        'start_working_date',
        'stop_working_date',
        'position',
        'education',
        'working_hour',
        'in_remark',
        'out_remark',
        'stop_working_reason',
        'type',
        'staff_in_id',
        'position_categories',
        'id_number',
        'phone_number',
        'updated_status',
        'working_log_request_id',
        'last_salary',
        'last_position',
        'staff_type',
        'emergency_name',
        'emergency_phone',
        'emergency_phone_2',
        'relationship',
        'phone_number_2',
        'fwp_id',
        'osh_number',
        'is_unout_request',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly( [
                'staff_movement_id',
                'bio_id',
                'remark',
                'name',
                'gender',
                'nationality',
                'dob',
                'workpermit_id',
                'salary',
                'salary_in_type',
                'start_working_date',
                'stop_working_date',
                'position',
                'education',
                'working_hour',
                'in_remark',
                'out_remark',
                'stop_working_reason',
                'type',
                'staff_in_id',
                'position_categories',
                'id_number',
                'phone_number',
                'updated_status',
                'working_log_request_id',
                'last_salary',
                'staff_type',
                'emergency_name',
                'emergency_phone',
                'emergency_phone_2',
                'relationship',
                'phone_number_2',
                'fwp_id',
                'last_position',
                'osh_number',
                'is_unout_request',
            ]);
    }
    public function staffmovement(){
        return $this->belongsTo('App\Models\StaffMovement\StaffMovement', 'staff_movement_id');
    }

    public function nationalities(){
        return $this->belongsTo('App\Models\Bio\Nationality', 'nationality');
    }

    public function bio(){
        return $this->belongsTo('App\Models\Bio\Bio', 'bio_id');
    }

    public function educations(){
        return $this->belongsTo('App\Models\Bio\Education', 'education');
    }

    public function positionCategories(){
        return $this->belongsTo('App\Models\Bio\PositionCategories', 'position_categories');
    }

    public function workingLogRequests(){
        return $this->belongsTo('App\Models\Bio\WorkingLogRequest', 'working_log_request_id');
    }

    public function reference_id(){
        return $this->belongsTo('App\Models\StaffMovement\StaffMovement', 'staff_in_id');
    }

    public function scopeAgedOver18($query)
    {
        return $query->whereDate(\DB::raw("STR_TO_DATE(dob, '%d-%m-%Y')"), '<=', now()->subYears(18));
    }

    public function scopeAgedBelow18($query)
    {
        return $query->whereDate(\DB::raw("STR_TO_DATE(dob, '%d-%m-%Y')"), '>', now()->subYears(18));
    }

    public function scopeCompany($query){
        if(\Auth::user()->is_company == 1)
            return $query->with(['staffmovement' => function($query){
                $query->where('company_id', \Auth::user()->company->id);
            }]);
    }
}
