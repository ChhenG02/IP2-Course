<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'cart'; 
    protected $dates = ['deleted_at']; // Ensure deleted_at is treated as a date
    protected $fillable = [
        'quantity',
        'product_id',
        'customer_id',
    ];
    // Cart belongsTo Product
    public function product() { return $this->belongsTo(Product::class); }
    
    // Cart belongsTo Customer
    public function customer() { return $this->belongsTo(Customer::class); }
}
