<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function create(Request $request){

        if(!Auth::check()){
            
            $data = $request->validate([
                'email' => ['required', 'email']
            ]);
        }

        $order = new Order;
        $order->email = Auth::check() ? Auth::user()->email : $data['email'];
        $order->save();
        
        $cart = session()->get('cart');

        foreach($cart as $cart_item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart_item['id'],
                'price' => $cart_item['price'],
                'quantity' => $cart_item['quantity'],
            ]);
        }

        return response()->json(['message' => 'Заказ оформлен']);
    }

    public function index(){
        $order = Order::where('email', Auth::user()->email)->with('order_items')->get();

        return response()->json(['order' => $order]);
    }
}
