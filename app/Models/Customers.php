<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'customer_id'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'customer_id',
        'name_customer',
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
        return User::where('pid', 3 . $pid)->where("id_type_users", 3)->first();
    }
    public function shipments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Shipments::class, 'customer_id');
    }
    public function isHasMany() {
        if ($this->shipments()->count() <= 0) {
            return true;
        }
        return false;
    }
}
