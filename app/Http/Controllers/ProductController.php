<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'image' => 'required|image',
            'product_code' => 'required|unique:products',
            'name' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        if($request->file('image')){
            $path = $request->file('image')->store('product_image');
            $validate['image'] = $path;
        }

        Product::create($validate);

        return redirect('/account/products')->with('flash', [
            'message' => 'Berhasil menambahkan data produk',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::whereNotIn('is_active', [false])->whereNotIn('id', [$product->category_id])->latest()->get();
        return Inertia::render('Account/Product/Edit', [
            'title' => 'Edit Produk',
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules =  [
            'image' => 'required',
            'product_code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required'
        ];


        if($request->file('image')){
            $rules['image']  =  'required|image';
            $pathImage = $request->file('image')->store('product_image');
            Storage::delete($product->image);
        }

        $validate = $request->validate($rules);

        $validate['image'] = $request->file('image') ? $pathImage : $validate['image'];

        $product->update($validate);

        return redirect('/account/products')->with('flash', [
            'message' => 'Berhasil merubah produk',
            'type' => 'success'
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->update(['is_active' => false]);

        return redirect('/products')->with('flash', [
            'message' => 'Berhasil menghapus data produk',
            'type' => 'success'
        ]);
    }
}
