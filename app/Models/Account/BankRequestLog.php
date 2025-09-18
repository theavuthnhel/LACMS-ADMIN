<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class BankRequestLog extends Model
{
	protected $table = "bank_request_log";
   
    protected $fillable = [
    	'account_id',
        'request_status',
        'bank',
        'request_ip'
    ];
}
