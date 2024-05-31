<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusShipments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'shipment_on_service';

    protected $fillable = [
        'id',
        'ship_id',
        'status_id',
        'delivery_id',
        'id_user',
        'date_update'
    ];
    public function shipment()
    {
        return $this->belongsTo(Shipments::class, 'ship_id');
    }
    public function city()
    {
        return $this->belongsTo(Regions::class, 'id_city');
    }

    public function state()
    {
        return $this->belongsTo(TypeShipStatus::class, 'status_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }
    public function delegate()
    {
        return $this->belongsTo(DeliveryMen::class, 'delivery_id');
    }

}
