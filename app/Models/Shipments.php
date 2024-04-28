<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipments extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_ship'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'id_ship',
        'name_ship',
        'id_customer',
        'id_status',
        'id_city',
        'ship_value',
        'phone_number',
        'phone_number2',
        'address',
        'notes',
        'recipient_name'
    ];

    public function city()
    {
        return $this->belongsTo(sub_cities::class, 'id_city');
    }

    public function state()
    {
        return $this->belongsTo(type_ship_status::class, 'id_status');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'id_customer');
    }
}
