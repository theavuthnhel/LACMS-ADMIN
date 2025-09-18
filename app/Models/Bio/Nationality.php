<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nationality extends Model
{
    protected $table = "nationality";

    protected $fillable = [
        'nationality',
        'nationality_kh',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort', 'asc');
        });
    }


    public function getFullNameAttribute()
    {
        return  $this->nationality_kh . ' | ' . $this->nationality;
    }
}
