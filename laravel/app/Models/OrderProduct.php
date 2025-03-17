<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class OrderProduct extends Model
{
    use HasFactory;
    use SoftDeletes; 
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
