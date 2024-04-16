<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialRole extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'material_roles';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_role', 'id_page', 'create', 'update', 'delete', 'show'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'id_page');
    }
}
