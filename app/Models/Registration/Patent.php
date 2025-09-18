<?php

namespace App\Models\Registration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Patent extends Model implements HasMedia
{
	use  InteractsWithMedia, SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $table = "patent";

    protected $fillable = [
    	'registration_id',
    	'patent_en',
		'patent_kh',
		'company_id',
    ];
}
