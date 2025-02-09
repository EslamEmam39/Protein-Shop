<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $cartItems = $user->cart()->with('product')->get();
        return response()->json($cartItems);
    }


    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    $cartItem = Cart::where('user_id', Auth::id())
        ->where('product_id', $request->product_id)
        ->first();

    if ($cartItem) {
        $cartItem->increment('quantity', $request->quantity);
    } else {
        $cartItem = Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
    }

    return response()->json($cartItem);
}


public function destroy($id)
{
    $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->first();
    if($cartItem == false){
        return response()->json(['message' => 'Not found ']);
    }
    $cartItem->delete();

    return response()->json(['message' => 'Item removed from cart']);
}

}
