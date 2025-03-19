<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'customer'; 
    protected $dates = ['deleted_at']; // Ensure deleted_at is treated as a date

    // fields
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
    ];

    // Customer hasMany carts
    public function carts() {return $this->hasMany(Cart::class);}

    // Customer hasMany wishlists
    public function wishlists() {return $this->hasMany(Wishlist::class);}

    // Customer hasMany orders
    public function orders() {return $this->hasMany(Order::class);}

    // Customer hasMany payments
    public function payments() {return $this->hasMany(Payment::class);}

    // Customer hasMany products through carts
    public function products(){return $this->hasManyThrough(Product::class, Cart::class, 'customer_id', 'id', 'id', 'product_id');}
}
