<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // return the relation of the table has_uppload_products
    public function uploadProducts()
    {
        return $this->belongsToMany(Products::class, 'has_upload_products', 'user_id', 'product_id');
    }

    // return the relation of the table has_bougth_products
    public function purchedProducts()
    {
        return $this->belongsToMany(Products::class, 'has_bought_products', 'user_id', 'product_id');
    }

    // get cart
    public function cart()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }
}
