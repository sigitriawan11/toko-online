<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(){
        return Inertia::render('Account/Profile', [
            'title' => Auth::user()->name
        ]);
    }

    public function products(Request $request){
        $products = $request->search ?  Product::whereNotIn('is_active', [false])->where('name', 'like', '%' . $request->search . '%')->latest()->get() :
                                        Product::whereNotIn('is_active', [false])->latest()->get();

        return Inertia::render('Account/Product', [
            'title' => 'Seluruh Produk',
            'products' => $products
        ]);
    }

    public function createProduct(){
        $categories =  Category::whereNotIn('is_active', [false])->latest()->get();
        return Inertia::render('Account/Product/Create', [
            'title' => 'Buat Produk Baru',
            'categories' => $categories
        ]);
    }

    public function categories(Request $request){
        $categories =  $request->search ? Category::whereNotIn('is_active', [false])->where('name', 'like', '%' . $request->search . '%')->latest()->get()
                                        : Category::whereNotIn('is_active', [false])->latest()->get();
        return Inertia::render('Account/Category', [
            'title' => 'Seluruh Kategori',
            'categories' => $categories
        ]);
    }

    public function createCategory(){
        return Inertia::render('Account/Category/Create', [
            'title' => 'Buat Kategori'
        ]);
    }
}
