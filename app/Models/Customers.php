<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
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

    public function user($pid)
    {
        return User::where('pid', $pid)->where("id_type_users", 3)->first();
    }
}
