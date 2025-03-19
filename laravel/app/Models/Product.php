<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products'; 
    protected $dates = ['deleted_at']; // Ensure deleted_at is treated as a date

    protected $fillable = [
        'name',
        'price',
        'description',
        'images',
        'category_id',
    ];

    // Product belongs to a category
    public function category() {return $this->belongsTo(Category::class);}

    // Product hasMany carts
    public function carts() {return $this->hasMany(Cart::class);}

    // Product hasMany wishlists
    public function wishlists() {return $this->hasMany(Wishlist::class);}

    // Product hasMany orderProducts
    public function orderProducts() {return $this->hasMany(OrderProduct::class);}

}
