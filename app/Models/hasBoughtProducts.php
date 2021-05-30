<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasBoughtProducts extends Model
{
    use HasFactory;

    protected $table = 'has_bought_products';

    protected $fillable = ['user_id', 'product_id'];
}
