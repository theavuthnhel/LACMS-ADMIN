<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class CSIC5 extends Model
{
    protected $table = "business_activities";

    protected $fillable = [];

    public function getFullNameAttribute()
    {
        return $this->code . "-" . $this->name_khmer;
    }
}
