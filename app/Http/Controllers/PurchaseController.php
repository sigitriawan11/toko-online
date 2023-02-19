<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PurchaseController extends Controller
{
    public function index(){
        $purchase = Purchase::where('user_id', Auth::user()->id)->latest()->get();
        return Inertia::render('Account/Purchase/Index', [
            'title' => 'Semua Pembelian',
            'purchase'=> $purchase
        ]);
    }

    public function createPurchase(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'province' => 'required',
            'city' => 'required',
            'address' => 'required',
            'product_code' => 'required',
        ]);

        $cart = Cart::where('product_code', $validate['product_code'])->where('user_id', Auth::user()->id)->first();
        $auth = base64_encode('SB-Mid-server-85v-isXm9x4X8qT6gRQzvx9Z:');
        $order_id = Str::upper(Str::random(10));

        $response = Http::withHeaders([
           'Accept' =>  'application/json',
           'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $auth
        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', [
            'transaction_details' => [
                "order_id" => $order_id,
                "gross_amount" => $cart->total_price
            ],
            'item_details' => [
                "id" => $cart->id,
                "price" => $cart->product->price,
                "quantity" => $cart->qty,
                "name" => $cart->product->name,
                "brand" => "Toko Online",
                "category" => $cart->product->category->name,
            ]
        ]);

        $purchase = Purchase::create([
            'user_id'=> Auth::user()->id,
            'order_id' => $order_id,
            'product_code' => $cart->product_code,
            'name' => $validate['name'],
            'phone' => $validate['phone'],
            'province' => $validate['province'],
            'city' => $validate['city'],
            'address' => $validate['address'],
            'qty' => $cart->qty,
            'total_price' => $cart->total_price,
            'token' => $response['token']
        ]);

        return redirect('/purchase/' . $purchase->token . '/checkout');
    }

    public function checkout(Purchase $purchase){
        $cart = Cart::where('product_code', $purchase->product_code)->where('user_id', Auth::user()->id)->first();
        return Inertia::render('Account/Purchase', [
            'title' => 'Pembayaran',
            'purchase' => $purchase,
            'cart' => $cart
        ]);
    }

    public function checkoutStatus(Request $request, Purchase $purchase){
        $purchase->update(['status'=> $request->status]);

        if($request->status == 'Sukses'){
            $cart = Cart::where('product_code', $purchase->product_code)->where('user_id', Auth::user()->id)->first();

            Cart::destroy($cart->id);

            $product = Product::where('product_code', $purchase->product_code)->first();
            $product->update(['stock' => $product->stock - $purchase->qty]);
        }

        return redirect('/purchase');
    }
}
