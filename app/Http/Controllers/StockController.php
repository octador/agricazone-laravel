<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\True_;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $stocks = Stock::where('user_id', $user->id)->get();
        $products = Product::whereIn('id', $stocks->pluck('product_id'))->get();
    
        return view('stocks.index', compact('stocks', 'products'));
    }
    // // diplay list unique farmer
    // public function indexFarmer(){
        

    
    //     return view('stocks.indexFarmer', compact('stocks', 'products'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();
        // dd($products[0]->id);
        $user = User::find(auth()->user()->id);
        // dd($user);
        return view('stocks.create', compact('products', 'user', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'category' => 'required|exists:categories,id',
            'product_id' => 'required|exists:products,id',
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
        ]);


        $stock = new Stock();
        $stock->product_id = $request->product_id;
        $stock->description = $request->description;
        $stock->quantity = $request->quantity;
        $stock->price = $request->price;
        $stock->user_id = $request->user_id;
        $stock->save();

        // Rediriger ou retourner une réponse appropriée
        return redirect()->route('dashboard')->with('success', 'Stock created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        return view('stocks.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $products = Product::all();
       
        return view('stocks.edit', compact('stock', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'is_available' => 'boolean',
            'product_id' => 'required|exists:products,id',
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
        ]);

        // Mettre à jour le stock
        $stock = Stock::findOrFail($id);
        $stock->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'votre stock a ete modiffier avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->route('dashboard')->with('success', 'votre stock a ete supprimer avec succes');
    }

    public function search()
    {
        $user = User::find(auth()->user()->id);

        // Récupérer tous les produits ayant `category_id` égal à l'ID de la catégorie
        $products = Product::whereIn('category_id', $user)->get();

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
    public function farmerid()
    {
        return view('stocks.farmerid');
    }
}
