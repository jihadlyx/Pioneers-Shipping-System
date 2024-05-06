<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_emp'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'id_emp',
        'name_emp',
        'phone_number',
        'phone_number2',
        'address',
        'image',
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
        return User::where('pid', $pid)->where("id_type_users", 1)->first();
    }
}
