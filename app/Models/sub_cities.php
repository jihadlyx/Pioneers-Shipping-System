<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_cities extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_city'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'id_city',
        'title',
        'price'
    ];
}
