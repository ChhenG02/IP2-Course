<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'order'; 
    protected $dates = ['deleted_at']; // Ensure deleted_at is treated as a date
    protected $fillable = [
        'total_price',
        'customer_id',
        'order_date',
    ];
    // Order belongsTo Customer
    public function customer() { return $this->belongsTo(Customer::class); }
    
    // Order hasMany Payments
    public function payments() { return $this->hasMany(Payment::class); }
    
    // Order hasMany OrderProducts
    public function orderProducts() { return $this->hasMany(OrderProduct::class); }

     // Accessor and Mutator for order_date
     protected function orderDate(): Attribute
     {
         return Attribute::make(
             // Mutator: Convert input format to MySQL format before saving
             set: fn ($value) => Carbon::createFromFormat('d/m/Y H:i:s', $value)->format('Y-m-d H:i:s'),
 
             // Accessor: Convert database format to user format when retrieving
             get: fn ($value) => Carbon::parse($value)->format('d/m/Y H:i:s')
         );
     }
}
