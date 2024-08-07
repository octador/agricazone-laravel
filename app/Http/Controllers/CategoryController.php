<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoriesRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $category = new Category();
    //     return view('category.create', compact('category')); //compact sert a crée un tableau associatif
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(CreateCategoriesRequest $request)
    // {
    //     //je cree un store pour enregistrer les reponses du formulaire
    //     //qui contient le nom de la categorie qui provient du route->controller->inputName de la view
    //     // Category::create([
    //     //     'name' => $request->name
    //     // ]);

    //     //2 comme j'ai mis mes contraite dans CreateCategoriesRequestje peux utiliser la methode validated
    //     Category::create($request->validated());
    //     // dd($request->validated());
    //     //une fois les donner enregistrer je veux retourner sur la page index
    //     //with('success', 'La catégorie a bien été ajoutée');permet d'afficher un message qui est saugarder dans la globale session
    //     //on dois afficher dans la view index avec @if(session('success')) > alert< @endif
    //     return redirect()->route('category.index')->with('success', 'La categorie ' . $request->name . ' a bien été ajoutée');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    public function show($id)
    {
        $category = Category::find($id);
        $products = Product::where('category_id', $category->id)->get();
        
        $stocks = Stock::whereIn('product_id', $products->pluck('id'))->get();
        
        return view('category.show', [
            'stocks' => $stocks,
        ]);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Request $request)
    // {
    //     return view('category.edit', [
    //         'category' => $request->category
    //     ]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(CreateCategoriesRequest $request, Category $category)
    // {
    //     $category->update($request->validated());
    //     return redirect()->route('categories.index')->with('success', 'La catégorie ' . $request->name . ' a bien été modifié');
    // }
    

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(CategoryController $category)
    // {
    //     //
    // }
}
