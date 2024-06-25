<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
    public function search($id)
    {
        // Récupérer tous les produits ayant `category_id` égal à l'ID de la catégorie
        $products = Product::where('category_id', $id)->get();
    
        // Récupérer les IDs des produits
        $productIds = $products->pluck('id');
    
        // Récupérer tous les stocks associés à ces produits
        $stocks = Stock::whereIn('product_id', $productIds)->get();
    
        // Récupérer les IDs des utilisateurs à partir des stocks
        $userIds = $stocks->pluck('user_id');
    
        // Récupérer tous les noms des utilisateurs associés aux stocks 
        $users = User::whereIn('id', $userIds)->select('name', 'id')->get();
    
        // Retourner la vue avec les données
        return view('stocks.search', [
            'stocks' => $stocks,
            'users' => $users,
            'products' => $products
        ]);
    }
    

}
