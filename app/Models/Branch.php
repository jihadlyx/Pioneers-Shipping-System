<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_branch'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'id_branch',
        'title',
        'address',
        'phone_number',
        'phone_number2',
        'state',
    ];

    public function isHasMany() {
        if ($this->employees()->count() <= 0 && $this->delegates()->count() <= 0 && $this->customers()->count() <= 0) {
            return true;
        }
        return false;
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'id_branch');
    }

    public function delegates()
    {
        return $this->hasMany(Delegate::class, 'id_branch');
    }

    public function customers()
    {
        return $this->hasMany(Customers::class, 'id_branch');
    }
}
