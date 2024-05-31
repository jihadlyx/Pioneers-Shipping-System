<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;

    protected $table = "pages";
    protected $primaryKey = 'page_id';
    protected $fillable = ["page_id", "title", "path"];
}
