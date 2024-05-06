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
    protected $primaryKey = 'id_role';
    protected $fillable = ["id_role", "title"];

    public function isHasMany() {
        if ($this->employees()->count() <= 0 && $this->delegates()->count() <= 0 && $this->customers()->count() <= 0) {
            return true;
        }
        return false;
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'id_role');
    }

    public function delegates()
    {
        return $this->hasMany(Delegate::class, 'id_role');
    }

    public function customers()
    {
        return $this->hasMany(Customers::class, 'id_role');
    }
}
