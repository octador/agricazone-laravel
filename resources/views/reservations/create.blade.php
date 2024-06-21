@extends('app')

@section('content') 

<h1>Create Reservation</h1>



<form action="{{ route('reservations.store') }}" method="POST">
    @csrf
@dump($reservation)
@dump($stock)
@dump(Auth::user()->id)
@dump($product)
@dump($user_collections)

<div>
    
    <h3>Produits : {{ $product->name }}</h3>
    <h3> Quantitées disponible : {{ $stock->quantity }} kg</h3>
    
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <input type ="hidden" name="status_id" value=3>
    <input type="hidden" name="stock_id" value="{{ $stock->id }}">
    <input type="hidden" name="price" value="{{ $stock->price }}">
    
    
    <div class="form-group">
        <label for="user_collection">point de vente</label>
        <select name="user_collection" id="user_collection" class="form-control">
            
            @foreach($user_collections as $user_collection)
                <option value="{{ $user_collection->id }}">{{ $user_collection->city }}</option>
            @endforeach
            
        </select>
    </div>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" class="form-control" max="{{ $stock->quantity }}" min="1">
    </div>
   <p> Prix {{ $stock->price }} €/kg</p>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Créé une nouvelle réservation</button>
    </div>
</form>

@endSection
