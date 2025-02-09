<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Auth::user()->orders()->with('items.product')->get());
    }

    public function store()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

           // تخزين المنتجات المرتبطة بالطلب

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // تفريغ السلة بعد إتمام الطلب
        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'message' => 'Order placed successfully',
            'order' => $order->load('items.product'),
        ]);
    }
  
    public function show($id)
{
    $order = Order::where('id', $id)->where('user_id', Auth::id())->with('items.product')->first();
    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }
    return response()->json($order);
}

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->first();
    
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
    
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,completed,canceled',
        ]);
    
        $order->update(['status' => $request->status]);
    
        return response()->json(['message' => 'Order status updated successfully', 'order' => $order]);
    }
    

 
}
 
