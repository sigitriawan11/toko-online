<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request) {
        $categories = Category::whereNotIn('is_active', [false])->latest()->get();
        $products = $request->search ? Product::whereNotIn('is_active', [false])->where('name', 'like', '%' . $request->search . '%')->latest()->get() :
                                        Product::whereNotIn('is_active', [false])->latest()->get();
        return Inertia::render('Home', [
            'categories' => $categories,
            'products'=> $products
        ]);
    }
}
