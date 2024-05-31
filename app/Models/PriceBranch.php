<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceBranch extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'prices';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'from_branch',
        'to_branch',
        'price',
    ];

    public function fromBranch()
    {
        return $this->belongsTo(Branch::class, 'from_branch');
    }

    public function toBranch()
    {
        return $this->belongsTo(Branch::class, 'to_branch');
    }


}
