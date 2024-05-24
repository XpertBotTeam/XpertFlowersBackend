<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
        'size',
        'description',
        'stock',
        'category_id',
    ];

    protected $table="products";

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
