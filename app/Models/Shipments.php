<?php

namespace App\Models;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipments extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function statusShipment($id_statue)
    {
        return StatusShipments::where('id_ship', $this->id_ship)
            ->where('id_status', $id_statue)
            ->first();
    }

    public function getPrice()
    {
        $branch = $this->city->id_branch;
        $price = PriceBranch::where('id_from_branch', $this->customer->id_branch)
            ->where('id_to_branch', $branch)
            ->first()->price;
        $price = $price + $this->city->price;
        return $price;
    }

    public function generateQrCode()
    {
        $data = "المعرّف: {$this->id_ship},"
            . "الاسم: {$this->name_ship},"
            . "اسم العميل: {$this->customer->name_customer},"
            . "الحالة: {$this->state->title},"
            . "اسم المدينة: {$this->city->title},"
            . "السعر: {$this->ship_value},"
            . "اسم المستلم: {$this->recipient_name},"
            . "رقم المستلم: 0{$this->phone_number},"
            . "العنوان: {$this->address},"
            . "ملاحظة: {$this->notes},";

        $dataString = json_encode($data, JSON_UNESCAPED_UNICODE);
        $qrCode = QrCode::generate($dataString);
        return $qrCode;

    }





}
