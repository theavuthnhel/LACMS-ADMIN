<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkerExcel extends Model
{
    use LogsActivity, SoftDeletes;

    protected $table = "worker_excel";

	protected $primaryKey = "id";

    protected $dates = ['deleted_at'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'company_id',
        'name',
        'gender',
        'dob',
        'id_number',
        'nationality',
        'phone_number',
        'position',
        'nssf_number',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'import_status',
        'request_id',
        'room_no',
        'vaccination_card',
        'bio_number',
        'last_vaccinated_date',
        'dose_type',
        'fwp_id',
        'dose_3',
        'dose_4',
        'dose_5',
        'is_bio',
        'is_upload',
        'reason',
        'is_not_vaccinated',
        'admin_delete_status',
        'company_deleted_at',
        'latin_name',
        'occupation',
        'code',
        'updated_by',
        'wing_account_create_status',
        'wing_account_create_date',
        'wing_print_card_status',
        'wing_print_card_date',
        'wing_account_number',
        'wing_status',
        'wing_sent_date',
        'is_send_to_wing',
        'salary',
        'p_province',
        'p_district',
        'p_commune',
        'p_village',
        'c_province',
        'c_district',
        'c_commune',
        'c_village',
        'nssf_status',
        'staff_id',
        'education',
        'start_working_date',
        'others',
        'is_register_book'
    ];

    protected static $logAttributes = [
        'company_id',
        'name',
        'gender',
        'dob',
        'id_number',
        'nationality',
        'phone_number',
        'position',
        'nssf_number',
        'house_no',
        'street',
        'group',
        'village',
        'commune',
        'district',
        'province',
        'import_status',
        'request_id',
        'room_no',
        'vaccination_card',
        'bio_number',
        'last_vaccinated_date',
        'dose_type',
        'fwp_id',
        'dose_3',
        'dose_4',
        'dose_5',
        'is_bio',
        'is_upload',
        'reason',
        'is_not_vaccinated',
        'admin_delete_status',
        'company_deleted_at',
        'latin_name',
        'occupation',
        'code',
        'updated_by',
        'wing_account_create_status',
        'wing_account_create_date',
        'wing_print_card_status',
        'wing_print_card_date',
        'wing_account_number',
        'wing_status',
        'wing_sent_date',
        'is_send_to_wing',
        'salary',
        'p_province',
        'p_district',
        'p_commune',
        'p_village',
        'c_province',
        'c_district',
        'c_commune',
        'c_village',
        'nssf_status',
        'staff_id',
        'education',
        'start_working_date',
        'others',
        'is_register_book'
    ];

    public  function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'company_id',
                'name',
                'gender',
                'dob',
                'id_number',
                'nationality',
                'phone_number',
                'position',
                'nssf_number',
                'house_no',
                'street',
                'group',
                'village',
                'commune',
                'district',
                'province',
                'import_status',
                'request_id',
                'room_no',
                'vaccination_card',
                'bio_number',
                'last_vaccinated_date',
                'dose_type',
                'fwp_id',
                'dose_3',
                'dose_4',
                'dose_5',
                'is_bio',
                'is_upload',
                'reason',
                'is_not_vaccinated',
                'admin_delete_status',
                'company_deleted_at',
                'latin_name',
                'occupation',
                'code',
                'updated_by',
                'wing_account_create_status',
                'wing_account_create_date',
                'wing_print_card_status',
                'wing_print_card_date',
                'wing_account_number',
                'wing_status',
                'wing_sent_date',
                'is_send_to_wing',
                'salary',
                'p_province',
                'p_district',
                'p_commune',
                'p_village',
                'c_province',
                'c_district',
                'c_commune',
                'c_village',
                'nssf_status',
                'staff_id',
                'education',
                'start_working_date',
                'others',
                'is_register_book'
            ]);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} WorkerExcel";
    }

    public function company(){
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }

    public function bio(){
        return $this->belongsTo('App\Models\Bio\Bio', 'id_number', 'id_number');
    }

    public function bio_approved(){
        return $this->belongsTo('App\Models\Bio\Bio', 'id_number', 'id_number')->where('status', 1);
    }

    public function workerWing(){
        return $this->hasOne('App\Models\Company\WorkerWing', 'worker_id');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User\User', 'updated_by');
    }

    public function scopeAgedOver18($query)
    {
        return $query->whereDate(\DB::raw("STR_TO_DATE(dob, '%d-%m-%Y')"), '<=', now()->subYears(18));
    }

    public function scopeAgedBelow18($query)
    {
        return $query->whereDate(\DB::raw("STR_TO_DATE(dob, '%d-%m-%Y')"), '>', now()->subYears(18));
    }

    public function upload_excel(){
        return $this->belongsTo('App\Models\Company\UploadExcel', 'request_id');
    }
}
