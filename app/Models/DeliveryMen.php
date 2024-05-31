<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryMen extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "delivery_men";
    protected $primaryKey = 'delivery_id'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'delivery_id',
        'delivery_name',
        'phone_number',
        'phone_number2',
        'address',
        'number_id',
        'branch_id',
        'role_id'
    ];

    // تعريف العلاقة مع جدول branches
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function user($pid)
    {
        return User::where('pid', 2 . $pid)->where("id_type_users", 2)->first();
    }

    public function isHasMany() {
        if ($this->statusShip()->count() <= 0) {
            return true;
        }
        return false;
    }

    public function statusShip()
    {
        return $this->hasMany(StatusShipments::class, 'delivery_id');
    }
}
