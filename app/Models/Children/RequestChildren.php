<?php

namespace App\Models\Children;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class RequestChildren extends Model implements HasMedia
{
	use LogsActivity, SoftDeletes, InteractsWithMedia;

	protected $dates = ['deleted_at'];

	protected $table = "request_children";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'code',
        'company_id',
        'status',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_status',
        'control_province',
        'payment_status',
        'payment_date',
        'edit_status',
        'approved_at',
        'approved_by',
        'provincial_control',
        'created_by',
        'updated_by',
        'type',
        'submitted_at',
        'certificate_code',
        'certificate_book_code',
        'request_name',
        'request_position',
        'request_phone',
        'request_gender',
        'children_request_type',
        'request_code',
        'children_request_age_type',
        'is_review',
        'payment_date_origin',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'code',
                'company_id',
                'status',
                'level_1',
                'level_2',
                'level_3',
                'level_4',
                'level_5',
                'level_status',
                'control_province',
                'payment_status',
                'payment_date',
                'edit_status',
                'approved_at',
                'approved_by',
                'provincial_control',
                'created_by',
                'updated_by',
                'type',
                'submitted_at',
                'certificate_code',
                'certificate_book_code',
                'request_name',
                'request_position',
                'request_phone',
                'request_gender',
                'children_request_type',
                'request_code',
                'children_request_age_type',
                'is_review',
                'payment_date_origin',
            ]);
    }
    public function children(){
        return $this->hasMany('App\Models\Children\RequestChildrenDetail', 'request_children_id');
    }
    public function createdBy(){
        return $this->belongsTo('App\Models\User\User', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }
    public function account()
    {
        return $this->morphToMany('App\Models\Account\Account', 'accountables');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

}
