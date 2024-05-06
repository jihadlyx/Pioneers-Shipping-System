<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'id_customer'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'id_customer',
        'name_customer',
        'phone_number',
        'phone_number2',
        'address',
        'id_number',
        'id_branch',
        'id_role'
    ];

    // تعريف العلاقة مع جدول branches
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id_branch');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function user($pid)
    {
        return User::where('pid', $pid)->where("id_type_users", 3)->first();
    }
    public function shipments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Shipments::class, 'id_customer');
    }
    public function isHasMany() {
        if ($this->shipments()->count() <= 0) {
            return true;
        }
        return false;
    }
}
