<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'comment',
        'user_id',
        'product_id',
    ];

    // https://github.com/laravel/ideas/issues/1940#issuecomment-558723063 se formatea cuando se hace un toJson
    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('Y-m-d');
    }

    // user that did the comment in the product
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
