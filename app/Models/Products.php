<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'available'
    ];

    // get the user from hasUploadProducts table.
    public function user(){
        return hasUploadProducts::where('product_id', $this->id)->first()->user ?? '';
    }
}
