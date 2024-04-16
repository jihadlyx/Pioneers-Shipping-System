<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
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
}
