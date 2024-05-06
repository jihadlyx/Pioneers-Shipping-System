<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeShipStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'type_ship_statuses';
    protected $primaryKey = 'id_status'; // تحديد مفتاح رئيسي مخصص

    protected $fillable = [
        'id_status',
        'title',
    ];
    public function shipments()
    {
        return $this->hasMany(Shipments::class, 'id_status');
    }
    public function isHasMany() {
        if ($this->shipments()->count() <= 0) {
            return true;
        }
        return false;
    }

}
//    type_ship_status
