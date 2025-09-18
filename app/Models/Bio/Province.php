<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    protected $table = "province";

    protected $fillable = [
        'pro_khname'
    ];
}
