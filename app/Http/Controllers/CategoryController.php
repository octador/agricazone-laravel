<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('category.index',[
            'categories' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryController $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryController $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryController $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryController $category)
    {
        //
    }
}
