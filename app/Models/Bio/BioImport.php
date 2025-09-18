<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BioImport extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $table = "bio_import";

    protected static $logOnlyDirty = true;

    protected $fillable = [
        "company_id",
        "name",
        "name_latin",
        "gender",
        "dob",
        "id_number",
        "personal_phone",
        "position",
        "start_working_date",
        "salary",
        "emergency_name",
        "emergency_phone",
        "emergency_phone_2",
        "spouse_name",
        "spouse_number",
        "is_renew",
        "deleted_at",
        "created_at",
        "updated_at",
        "nssf_number",
        "relationship",
        "id_expired_date",
    ];
}
