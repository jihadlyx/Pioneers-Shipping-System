<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'emp_id'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'emp_id',
        'emp_name',
        'phone_number',
        'phone_number2',
        'address',
        'image',
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
        return User::where('pid', 1 . $pid)->where("id_type_users", 1)->first();
    }
}
