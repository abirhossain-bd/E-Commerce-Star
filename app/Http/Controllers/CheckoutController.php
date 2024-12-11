<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $cart_prods = Cart::where('user_id', Auth::id())->where('quantity','!=',0)->get();
        $total_payout = 0;
        foreach ($cart_prods as $cart) {
            $total_payout = $total_payout + $cart->product->discount_price * $cart->quantity;
        }
        return view('checkout',compact('cart_prods','total_payout'));
    }
}
