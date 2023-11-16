<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function add($id){
        $product = Product::find($id);

        if(!$product) {
            return response()->json(['message' => 'Товар не найден'], 404);
        }

        $cart = session()->get('cart');

        if(!$cart) {
            $cart = [
                $id => [
                    "id" => $product->id,
                    "quantity" => 1,
                    "price" => $product->price
                ]
            ];

            session()->put('cart', $cart);

            return response()->json(['message' => 'Товар добавлен']);
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return response()->json(['message' => 'Товар добавлен']);
        }
        
        $cart[$id] = [
            "id" => $product->id,
            "quantity" => 1,
            "price" => $product->price
        ];

        session()->put('cart', $cart);

        return response()->json(['message' => 'Товар добавлен']);
    }

    public function update(Request $request){

        $data = $request->validate([
            'products' => ['required', 'array']
        ]);

        foreach($data['products'] as $item){
            if($item['id'] && $item['quantity']){
                $product = Product::find($item['id']);

                if(!$product) {
                    return response()->json(['message' => 'Товар не найден'], 404);
                }

                $cart = session()->get('cart');

                $cart[$item['id']]["quantity"] = $item['quantity'];

                session()->put('cart', $cart);
            }else abort(404);            
        }
        
        return response()->json(['message' => 'Корзина обновлена']);
    }

    public function delete(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            return response()->json(['message' => 'Товар удалён']);
        }
        abort(404);
    }
}
