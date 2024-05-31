<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialRole extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'role_id', 'page_id', 'create', 'update', 'delete', 'show'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
