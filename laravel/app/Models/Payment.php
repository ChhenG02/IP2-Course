<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'payment'; 
    protected $dates = ['deleted_at']; // Ensure deleted_at is treated as a date
    protected $fillable = [
        'payment_method',
        'amount',
        'order_id',
        'customer_id',
    ];
    // Payment belongs to a product
    public function product() { return $this->belongsTo(Product::class); }
    
    // Payment belongs to an order
    public function order() { return $this->belongsTo(Order::class); }
}
