<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render();
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
            'name' => 'required'
        ]);

        $validate['slug'] = Str::slug($validate['name']);

        Category::create($validate);

        return redirect('/account/categories')->with('flash', [
            'message' => 'Berhasil menambahkan kategori',
            'type'=> 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('Account/Category/Edit', [
            'title' => 'Edit Kategori',
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $validate['slug'] = Str::slug($validate['name']);

        $category->update($validate);

        return redirect('/account/categories')->with('flash', [
            'message' => 'Berhasil merubah kategori',
            'type'=> 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->update(['is_active' => false]);

        return redirect('/account/categories')->with('flash', [
            'message' => 'Berhasil menghapus kategori',
            'type'=> 'success'
        ]);
    }
}
