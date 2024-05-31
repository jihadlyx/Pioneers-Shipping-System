<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'branch_id'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'branch_id',
        'title',
        'address',
        'phone_number',
        'phone_number2',
        'status',
    ];

    public function isHasMany() {
        if ($this->employees()->count() <= 0 && $this->delegates()->count() <= 0 && $this->customers()->count() <= 0) {
            return true;
        }
        return false;
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'branch_id');
    }

    public function delegates()
    {
        return $this->hasMany(DeliveryMen::class, 'branch_id');
    }

    public function customers()
    {
        return $this->hasMany(Customers::class, 'branch_id');
    }
    public function shipments()
    {
        return $this->hasManyThrough(Shipments::class, Customers::class, 'branch_id', 'customer_id');
    }

    public function hasValidShipments()
    {
        // جلب الشحنات مع الحالات المحددة
        $shipments = $this->shipments()->whereIn('status_id', [1, 2])->count();

        // إذا كان هناك أي شحنة بهذه الحالات، أرجع false، وإلا أرجع true
        return $shipments <= 0;
    }

}
