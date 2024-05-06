<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusShipments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'status_shipments';
    protected $primaryKey = 'id_status'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'id',
        'id_ship',
        'id_status',
        'id_delegate',
        'id_user',
        'date_update'
    ];
    public function shipment()
    {
        return $this->belongsTo(Shipments::class, 'id_ship');
    }
    public function city()
    {
        return $this->belongsTo(SubCities::class, 'id_city');
    }

    public function state()
    {
        return $this->belongsTo(TypeShipStatus::class, 'id_status');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'id_customer');
    }
    public function delegate()
    {
        return $this->belongsTo(Delegate::class, 'id_delegate');
    }

}
