<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regions extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'region_id';


    protected $fillable = [
        'region_id',
        'title',
        'price',
        'branch_id'
    ];

    public function isHasMany() {
        if ($this->shipments()->count() <= 0) {
            return true;
        }
        return false;
    }
    public function shipments()
    {
        return $this->hasMany(Shipments::class, 'region_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function getPrice()
    {
        $branch = Auth()->user()->findUserByType(Auth()->user()->id_type_users)->branch;
        $price_branch = PriceBranch::where('from_branch', $branch->branch_id)
                            ->where('to_branch', $this->branch_id)
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
