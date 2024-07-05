@extends('layouts.app')

@section('title', 'Stock Search')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Stock Search Results</h1>
    

    @if($stocks->isEmpty())
    <div class="alert alert-info" role="alert">
        Aucun stock trouvé pour cette recherche.
    </div>

    <a href="{{ route('stocks.create') }}">Creer un nouveau stock</a>
    <a href="{{ route('stocks.index') }}">Retour a la page index</a>
    @else
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                
                <tr>
                    <th scope="col">Propriété</th>
                    @foreach($stocks as $stock)
                    @foreach($users as $user)
                    @if($stock->user_id == $user->id)
                    <th scope="col">{{ $user->name }}</th>
                    @endif
                    @endforeach
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Description</th>
                    @foreach($stocks as $stock)
                    <td>{{ $stock->description }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">Quantité</th>
                    @foreach($stocks as $stock)
                    <td>{{ $stock->quantity }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">Prix</th>
                    @foreach($stocks as $stock)
                    <td>{{ $stock->price }} €</td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">Produit</th>
                    @foreach($stocks as $stock)
                    <td>
                        @foreach($products as $product)
                        @if($product->id == $stock->product_id)
                        {{ $product->name }}
                        @endif
                        @endforeach
                    </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">Action</th>
                    @foreach($stocks as $stock)
                    <td>
                        <a href="{{ route('reservations.create', $stock->id) }}" class="btn btn-primary">Réserver</a>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    <a href="{{ route('stocks.create') }}">Creer un nouveau stock</a>
    @endif
</div>

@endsection