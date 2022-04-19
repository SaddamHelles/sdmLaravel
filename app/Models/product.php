<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    // protected $fillable = ['name', 'image', 'desc', 'price', 'discount', 'category_id'];
    protected $guarded = [];
    // protected $table = 'products';
}
