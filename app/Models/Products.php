<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'available',
        'category_id',
    ];

    // get the user from hasUploadProducts table.
    public function user()
    {
        return hasUploadProducts::where('product_id', $this->id)->first()->user ?? '';
    }

    public function comments()
    {
        return $this->hasMany(Comments::class,'product_id');
    }
}
