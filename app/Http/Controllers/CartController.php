<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index(){
        $cart_prods = Cart::where('user_id', Auth::id())->get();
        return view('cart',compact('cart_prods'));
    }



    public function addCart(Request $request){
        $carts = Cart::where('user_id', Auth::id())
                        ->where('product_id',$request->prod_id)->first();

        if (!$carts) {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->prod_id,
                'created_at' => now(),
            ]);
        }

        $cart_count = Cart::where('user_id', Auth::id())->count();

        return response()->json(['success' => true, 'cart_count' => $cart_count, 'message' => 'Product added to cart successfully']);
    }



    public function updateCart(Request $request){
        Cart::find($request->cart_id)->update([
            'quantity' => $request->quantity,
            'updated_at' => now(),
        ]);
        $cart_count = Cart::where('user_id', Auth::id())->count();
        return response()->json(['success' => true, 'cart_count' => $cart_count]);

    }

    public function removeCart(Request $request){
        Cart::find($request->cart_id)->delete();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        return response()->json(['success' => true, 'cart_count' => $cart_count]);
    }

    public function totalPayout(){
        $carts = Cart::where('user_id',Auth::id())->get();
        $total_payout = 0;
        foreach ($carts as $cart) {
            $total_payout = $total_payout + $cart->product->discount_price * $cart->quantity;
        }
        return response()->json(['success' => true, 'total_payout' => $total_payout]);
    }

}
