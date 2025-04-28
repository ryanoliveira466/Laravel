<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'car_brand',
        'car_name',
        'car_year',
        'car_price',
    ];
}
