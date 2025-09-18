<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class Accountables extends Model
{
    protected $fillable = [];

    public function account()
    {
        return $this->belongsTo('App\Models\Account\Account', 'account_id');
    }

    public function bio()
    {
        return $this->belongsTo('App\Models\Bio\Bio', 'accountables_id');
    }

    public function children()
    {
        return $this->belongsTo('App\Models\Children\RequestChildren', 'accountables_id');
    }

    public function staffmovement()
    {
        return $this->belongsTo('App\Models\StaffMovement\StaffMovement', 'accountables_id');
    }

    public function physical()
    {
        return $this->belongsTo('App\Models\Physical\Physical', 'accountables_id');
    }

    public function physicallabour()
    {
        return $this->belongsTo('App\Models\Physical\PhysicalLabour', 'accountables_id');
    }

    public function reprint()
    {
        return $this->belongsTo('App\Models\Bio\BioRequestReprint', 'accountables_id');
    }

    public function visa()
    {
        return $this->belongsTo('App\Models\Bio\WorkingLogRequest', 'accountables_id');
    }

    public function vote()
    {
        return $this->belongsTo('App\Models\Vote\Vote', 'accountables_id');
    }
    public function request_ot()
    {
        return $this->belongsTo('App\Models\Inspection\RequestOT', 'accountables_id');
    }

    public function request_ir()
    {
        return $this->belongsTo('App\Models\Inspection\RequestIR', 'accountables_id');
    }

    public function apprenticeship()
    {
        return $this->belongsTo('App\Models\Apprenticeship\Apprenticeship', 'accountables_id');
    }

    public function registration()
    {
        return $this->belongsTo('App\Models\Registration\Registration', 'accountables_id');
    }

    public function suspension()
    {
        return $this->belongsTo('App\Models\Inspection\Suspension', 'accountables_id');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School\School', 'accountables_id');
    }

    public function request_book_payroll()
    {
        return $this->morphedByMany('App\Models\Inspection\RequestBookPayroll', 'accountables_id');
    }

}
