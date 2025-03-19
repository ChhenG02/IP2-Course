<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class OrderProduct extends Model
{
    use HasFactory;
    use SoftDeletes; 
     protected $table = 'order_product';
    protected $dates = ['deleted_at']; // Ensure deleted_at is treated as a date 
    protected $fillable = [
        'product_id',
        'order_id',
        'price',
        'quantity',
    ];
    // OrderProduct belongsTo Product
    public function product() { return $this->belongsTo(Product::class); }
    
    // OrderProduct belongsTo Order
    public function order() { return $this->belongsTo(Order::class); }
}
