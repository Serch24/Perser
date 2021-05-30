<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class hasUploadProducts extends Model
{
    use HasFactory;

    protected $table = 'has_upload_products';

    protected $fillable = ['user_id','product_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
