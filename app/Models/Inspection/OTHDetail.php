<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class OTHDetail extends Model
{
	protected $table = 'oth_detail';

    protected $fillable = [
    	'request_ot_id',
    	'date_3',
    ];

    public function request_ot()
    {
        return $this->belongsTo(RequestOT::class, 'request_ot_id');
    }
}
