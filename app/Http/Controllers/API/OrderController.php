<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders; 
        return response()->json([
            'status'=>true,
            'data'=>$orders,
            'message'=>"list of products"
        ]);
    }

    public function store(Request $request){
        $order= new Order();
        $order->purchaseDate=now();
        $order->totalPrice=0;
        $order->user_id=Auth::id();
        $order->save();

        $items = $request->input('items');
        foreach ($items as $item) {
            $orderItem = new OrderDetails();
            $orderItem->quantity =$item['quantity'];
            $orderItem->currentPrice =$item['currentPrice'];
            $orderItem->order_id =$order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->save();

           $order->totalPrice += $item['quantity'] * $item['currentPrice'];
        }

        $order->save(); 
        return response()->json([
            'status' => true,
            'data' => $order,
            'message' => 'Order Placed Successfully'
        ]);
    }
    public function show($id)
    {
        $order=Order::find($id);
        if (!$order || $order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access: You do not have permission to view this order.');
        }
            if($order)
            {
                return response()->json([
                    'status'=>true,
                    'data'=>$order,
                    'message'=>'order information'
                ]);
            }else
            {
                return response()->json([
                    'status'=>false,
                    'data'=>null,
                    'message'=>'Order not found'
                ]);
            }
    }
}
