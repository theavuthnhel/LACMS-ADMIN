<?php

namespace App\Models\StaffMovement;

use Illuminate\Database\Eloquent\Model;
use DB;

class BusinessActivity extends Model
{
    protected $table = "main_business_activities";

    protected $fillable = [
    	'au',
    	'code',
    	'name_en',
    	'name_kh'
    ];

    public function scopeItems($query){
    	return $query->where('code', '!=', '');
    }

    public function scopeItemsFirst($query){
        return $query->whereRaw('LENGTH(code) = 1');
    }

    public function scopeItemsSecond($query, $code){
        return $query->whereRaw('LENGTH(code) = 2')->where('au', $code);
    }

    public function scopeItemsThird($query, $code, $code_1){
        return $query->whereRaw('LENGTH(code) = 3')->where('au', $code_1)->where(DB::raw('SUBSTRING(code, 1,2)'), $code);
    }

    public function scopeItemsFourth($query, $code, $code_1){
        return $query->whereRaw('LENGTH(code) = 4')->where('au', $code_1)->where(DB::raw('SUBSTRING(code, 1,3)'), $code);
    }

    public function getFullNameAttribute()
    {
        return $this->code . ' | ' . $this->name_kh . ' | ' . $this->name_en;
    }

    public function getFullNameSubAttribute()
    {
        return $this->au.$this->code . ' | ' . $this->name_kh . ' | ' . $this->name_en;
    }

}
