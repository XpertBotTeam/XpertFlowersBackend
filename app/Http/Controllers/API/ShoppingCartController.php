<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart= new ShoppingCart();
        $cart->totalPrice=0;
        $cart->user_id=Auth::id();
        $cart->save();
        $items = $request->input('items');
        foreach ($items as $item) {
            $cartItems = new CartItem();
            $cartItems->quantity =$item['quantity'];
            $cartItems->cart_id =$cart->id;
            $cartItems->product_id = $item['product_id'];
            $cartItems->save();
            $product = Product::find($item['product_id']);
           $cart->totalPrice += $item['quantity'] * $product->Price;
        }

        $cart->save(); 
        return response()->json([
            'status' => true,
            'data' => $cart,
            'message' => 'Items added to Shopping cart'
        ]);

        $cart->save();
    }

    public function removeFromCart(Request $request)
    {
        $cartItemId = $request->input('cart_item_id');
        $cartItem = CartItem::find($cartItemId);
        
        if(!$cartItem) {
            return response()->json([
                'status' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $cart = $cartItem->cart;
        $product = $cartItem->product;
        $cart->totalPrice -= $cartItem->quantity * $product->price;
        $cart->save();
        $cartItem->delete();

        return response()->json([
            'status' => true,
            'message' => 'Item removed from Shopping cart'
        ]);
    }

    public function clearCart(Request $request)
    {
        $cartId = $request->input('cart_id');
        $cart = ShoppingCart::find($cartId);
        
        if(!$cart) {
            return response()->json([
                'status' => false,
                'message' => 'Cart not found'
            ], 404);
        }

        $cart->cartItems()->delete();
        $cart->totalPrice = 0;
        $cart->save();

        return response()->json([
            'status' => true,
            'message' => 'Shopping cart cleared successfully'
        ]);
    }

    public function show()
    {
        $user = Auth::user();
        $cart = ShoppingCart::where('user_id', $user)->first();        
        dd($cart);
        if (!$cart) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Shopping cart not found'
            ]);
        }
    
        $cartItems = $cart->cartItems;
        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'No items in the shopping cart'
            ]);
        }
    
        return response()->json([
            'status' => true,
            'data' => $cart,
            'message' => 'Products in the shopping cart'
        ]);
    }
    

}
