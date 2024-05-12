<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceBranch extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'price_branch';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_from_branch',
        'id_to_branch',
        'price',
    ];

    public function fromBranch()
    {
        return $this->belongsTo(Branch::class, 'id_from_branch');
    }

    public function toBranch()
    {
        return $this->belongsTo(Branch::class, 'id_to_branch');
    }


}
