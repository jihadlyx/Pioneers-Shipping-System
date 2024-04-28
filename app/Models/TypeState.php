<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeState extends Model
{
    use HasFactory;
//    use SoftDeletes;

    protected $table = 'type_ship_status';
    protected $primaryKey = 'id_state'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'id_state',
        'title',
    ];

}
//    type_ship_status
