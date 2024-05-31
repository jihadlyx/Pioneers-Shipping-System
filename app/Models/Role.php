<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "roles";
    protected $primaryKey = 'role_id';
    protected $fillable = [
        "role_id",
        "title",
        'emp_id'
    ];

    public function isHasMany() {
        if ($this->employees()->count() <= 0 && $this->delegates()->count() <= 0 && $this->customers()->count() <= 0) {
            return true;
        }
        return false;
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'role_id');
    }

    public function delegates()
    {
        return $this->hasMany(DeliveryMen::class, 'role_id');
    }

    public function customers()
    {
        return $this->hasMany(Customers::class, 'role_id');
    }
}
