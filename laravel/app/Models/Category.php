<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories'; 
    protected $dates = ['deleted_at']; // Ensure deleted_at is treated as a date

    protected $fillable = ['name'];

    // Category has many products
    public function products(){return $this->hasMany(Product::class);}
}
