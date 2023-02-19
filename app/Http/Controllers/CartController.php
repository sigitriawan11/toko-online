<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(){
        $carts = Cart::where('user_id', Auth::user()->id)->latest()->get();
        return Inertia::render('Account/Cart', [
            'title' => 'Semua keranjang',
            'carts' => $carts
        ]);
    }

    public function store(Request $request){

        $cart = Cart::where('product_code', $request->product_code)->where('user_id', Auth::user()->id)->first();

        if($cart){
            $total_qty = $cart->qty + 1;
            $cart->update(['qty' => $total_qty, 'total_price' => $cart->product->price * $total_qty]);
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_code' => $request->product_code,
                'qty' => 1,
                'total_price' => $request->price
            ]);
        }

        return redirect('/');
    }

    public function show(Cart $cart){
        return Inertia::render('Account/Cart/Show', [
            'title' => 'Pay ' . $cart->product->name,
            'cart' => $cart
        ]);
    }
}
