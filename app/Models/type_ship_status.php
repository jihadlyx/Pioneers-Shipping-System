<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_ship_status extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_status'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'id_status',
        'title'
    ];
}
