<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'cart_id',
        'product_id',
    ];

    protected $table="cart_items";

    public function cart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
