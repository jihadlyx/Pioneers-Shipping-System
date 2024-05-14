<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCities extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_city'; // تحديد مفتاح رئيسي مخصص


    protected $fillable = [
        'id_city',
        'title',
        'price',
        'id_branch'
    ];

    public function isHasMany() {
        if ($this->shipments()->count() <= 0) {
            return true;
        }
        return false;
    }
    public function shipments()
    {
        return $this->hasMany(Shipments::class, 'id_city');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id_branch');
    }
    public function getPrice()
    {
        $branch = Auth()->user()->findUserByType(Auth()->user()->id_type_users)->branch;
        $price_branch = PriceBranch::where('id_from_branch', $branch->id_branch)
                            ->where('id_to_branch', $this->id_branch)
                            ->first();
        if($price_branch){
            $price = $price_branch->price;
        } else {
            $price = 0;
        }
        $price = $price + $this-> price;
        return $price;
    }
}
