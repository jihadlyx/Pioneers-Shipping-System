<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delegate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_delegate'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'id_delegate',
        'name_delegate',
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
        return User::where('pid', $pid)->where("id_type_users", 2)->first();
    }

    public function isHasMany() {
        if ($this->statusShip()->count() <= 0) {
            return true;
        }
        return false;
    }

    public function statusShip()
    {
        return $this->hasMany(StatusShipments::class, 'id_delegate');
    }
}
