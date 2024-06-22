@extends('app')

@section('content') 

<h1>Create Reservation</h1>



<form action="{{ route('reservations.store') }}" method="POST">
    @csrf
@dump($reservation)
@dump($stock)
@dump(Auth::user()->id)
@dump($product)

<div>
    
    <h3>Produits : {{ $product->name }}</h3>
    <h3> Quantitées disponible : {{ $stock->quantity }} kg</h3>
    
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <input type ="hidden" name="status_id" value=3>
    <input type="hidden" name="stock_id" value="{{ $stock->id }}">
    <input type="hidden" name="price" value="{{ $stock->price }}">
    
    
    <div class="form-group">
        <label for="collection_id">point de vente</label>
        <select name="collection_id" id="collection_id" class="form-control">
            
            @foreach($collection_ids as $collection_id)
                <option value="{{ $collection_id->id }}">{{ $collection_id->city }}</option>
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
