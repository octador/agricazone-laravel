<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\Status;
use App\Models\Stock;
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

        $reservations = Reservation::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        // On récupère le statut de la réservation du utilisateur
        $status_id = $reservations->pluck('status_id')->first();
        $status_name = Status::find($status_id)?->state;
        // recuperer le nom du produit
        return view('reservations.index', compact('reservations', 'status_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $stock_id)
    {
        $stock = Stock::find($stock_id);
        $user_id = $stock->user_id;

        $collection_id = Collection::where('user_id', $user_id)->get();

        $product_id = $stock->product_id;
        $product = Product::find($product_id);

        $reservation = new Reservation();
        return view('reservations.create', [
            'reservation' => $reservation,
            'stock' => $stock,
            'product' => $product,
            'collection_ids' => $collection_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $stock = Stock::findOrFail($request->stock_id);
        // dd($stock);
        $stock->update([
            'quantity' => $stock->quantity - $request->quantity,
        ]);

        $price = $request->get('price');
        $count = $price * $request->get('quantity');
        $request->merge(['total_price' => $count]);

        // dd($request->all());
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
            'stock_id' => 'required|exists:stocks,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:1',
            'collection_id' => 'required|exists:collection,id'
        ]);
        // dd($validated);

        // Création de la réservation
        Reservation::create($validated);

        // dd($validated);
        // Redirection ou autre action après la création
        return redirect()->route('reservations.index')->with('success', 'Votre réservation a bien été créée. Le montant total est de ' . $count . ' €');
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
}
