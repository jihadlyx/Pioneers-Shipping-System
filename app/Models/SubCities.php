<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCities extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_city'; // تحديد مفتاح رئيسي مخصص


    protected $fillable = [
        'id_city',
        'title',
        'price',

    ];
}
