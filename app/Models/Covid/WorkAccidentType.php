<?php

namespace App\Models\Covid;

use Illuminate\Database\Eloquent\Model;

class WorkAccidentType extends Model
{

	protected $table = "work_accident_type";

	protected $primaryKey = "id";

    protected $fillable = [
		'name',
        'created_by',
        'updated_by'
    ];

    protected static $logAttributes = [
		'name',
        'created_by',
        'updated_by'
    ];
}
