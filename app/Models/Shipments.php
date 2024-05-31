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

    protected $primaryKey = 'ship_id'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'ship_id',
        'ship_name',
        'customer_id',
        'status_id',
        'region_id',
        'ship_value',
        'phone_number',
        'phone_number2',
        'address',
        'notes',
        'name_recipient'
    ];

    public function city()
    {
        return $this->belongsTo(Regions::class, 'region_id');
    }

    public function state()
    {
        return $this->belongsTo(TypeShipStatus::class, 'status_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function statusShipment($id_statue)
    {
        return StatusShipments::where('ship_id', $this->ship_id)
            ->where('status_id', $id_statue)
            ->first();
    }

    public function getPrice()
    {
        $branch = $this->city->branch_id;
        $price_branch = PriceBranch::where('from_branch', $this->customer->branch_id)
            ->where('to_branch', $branch)
            ->first();
        if($price_branch){
            $price = $price_branch->price;
        } else {
            $price = 0;
        }
        $price = $price + $this->city->price;
        return $price;
    }

    public function generateQrCode()
    {
        $data = "المعرّف: {$this->ship_id},"
            . "الاسم: {$this->ship_name},"
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
