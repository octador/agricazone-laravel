<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\Status;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Log;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = auth()->user();

    // Récupère les réservations de l'utilisateur et joint les tables stocks et products
    $reservations = Reservation::where('reservations.user_id', $user->id)
        ->join('stocks', 'reservations.stock_id', '=', 'stocks.id')
        ->join('products', 'stocks.product_id', '=', 'products.id')
        ->select('reservations.*', 'products.name as product_name')
        ->orderBy('reservations.created_at', 'desc')
        ->get();

    // Récupère le statut de la première réservation de l'utilisateur
    $status_id = $reservations->pluck('status_id')->first();
    $status_name = Status::find($status_id)?->state;

    return view('reservations.index', compact('reservations', 'status_name'));
}




    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Récupérer l'objet Product correspondant à l'ID passé en paramètre
        $product = Product::find($id);

        // Récupérer toutes les entrées de Stock dont le product_id correspond à l'ID du produit
        $stocks = Stock::where('product_id', $product->id)->get();

        $usersId = $stocks->pluck('user_id')->unique()->toArray();

        $users = User::whereIn('id', $usersId)->get();
        // Extraire les IDs des collections de tous les utilisateurs
        $collections = Collection::whereIn('user_id', $usersId)->get();

        return view('reservations.create', compact('product', 'stocks', 'collections', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $stock = Stock::findOrFail($request->stock_id);

        // Validation des données
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
            'stock_id' => 'required|exists:stocks,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:1',
            'collection_id' => 'required|exists:collections,id'
        ]);

        // Mettre à jour la quantité du stock
        if ($stock->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Quantité insuffisante en stock.');
        }

        $stock->update([
            'quantity' => $stock->quantity - $request->quantity,
        ]);

        // Calcul du prix total
        $price = $stock->price;
        $totalPrice = $price * $request->quantity;
        $validated['total_price'] = $totalPrice;

        // Création de la réservation
        Reservation::create($validated);

        // Redirection après la création
        return redirect()->route('reservations.index')->with('success', 'Votre réservation a bien été créée. Le montant total est de ' . $totalPrice . ' €');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::find($id);
        $stock = Stock::find($reservation->stock_id);
        $product = Product::find($stock->product_id);
        $collection = Collection::find($reservation->collection_id);
        $status = Status::find($reservation->status_id);

        // dd($product_id->name);


        return view('reservations.show', compact('reservation', 'product', 'stock', 'collection', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::find($id);
        $stock = Stock::find($reservation->stock_id);
        $product = Product::find($stock->product_id);
        $collections = Collection::where('user_id', $stock->user_id)->get();

        return view('reservations.edit', compact('reservation', 'stock', 'product', 'collections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, Request $request)
    {




        // return redirect()->route('reservations.index')->with('success', 'La reservation a bien été mise à jour');
        $reservation = Reservation::find($id);
        $stock = Stock::find($reservation->stock_id);
        // Récupérer l'ancienne quantité réservée pour ajuster le stock correctement
        $ancienneQuantite = $reservation->quantity;

        // Calculer la nouvelle quantité totale
        $nouvelleQuantite = $request->input('quantity');


        Log::info("Ancienne quantité: $ancienneQuantite, Nouvelle quantité: $nouvelleQuantite, Stock avant ajustement: {$stock->quantity}");
        // Ajuster la quantité du stock
        $stock->quantity = $stock->quantity + $ancienneQuantite - $nouvelleQuantite;
        $stock->update();

        // Mettre à jour les informations de la réservation
        $reservation->quantity = $nouvelleQuantite;
        $reservation->total_price = $stock->price * $nouvelleQuantite;
        $reservation->collection_id = $request->input('collection_id');
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'La réservation a bien été mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $reservation = Reservation::find($id);
        $stock = Stock::find($reservation->stock_id);

        // Ajuster la quantité du stock en ajoutant la quantité de la réservation supprimée
        $stock->quantity += $reservation->quantity;
        $stock->save();

        // Supprimer la réservation
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'La réservation a bien été supprimée');
    }
    // Recherche for farmer
    public function search($id)
    {
        $user = User::find(auth()->user()->id);
        // dd($user);  
        $stocks = Stock::where('user_id', $user->id)->get();

        $reservations = Reservation::whereIn('stock_id', $stocks->pluck('id'))->get();
        $custommers = User::whereIn('id', $reservations->pluck('user_id'))->get();

        return view('reservations.search', compact('reservations', 'custommers', 'stocks'));
    }
}
