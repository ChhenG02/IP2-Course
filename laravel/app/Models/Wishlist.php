<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'wishlist'; 
    protected $dates = ['deleted_at']; // Ensure deleted_at is treated as a date
    protected $fillable = [
        'product_id',
        'customer_id',
    ];
    // Wishlist belongsTo Product
    public function product() { return $this->belongsTo(Product::class); }
    
    // Wishlist belongsTo Customer
    public function customer() { return $this->belongsTo(Customer::class); }
}
