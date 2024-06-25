<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\Status;
use App\Models\Stock;
use Illuminate\Http\Request;
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

        // Redirection ou autre action après la création
        return redirect()->route('reservations.index')->with('success', 'Votre réservation a bien été créée. Le montant total est de ' . $count . ' €');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id) 
    {
        $reservation = Reservation::find($id);
        $stock_id = Stock::find($reservation->stock_id);
        $product_id = Product::find($stock_id->product_id); 
        dd($product_id->name);
        

        return view('reservations.show', compact('reservation','product_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
