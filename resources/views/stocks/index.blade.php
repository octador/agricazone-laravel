@extends('app')

@section('content')
    <h1>Produits de la catégorie : {{ $category->name }}</h1>

    @if($category->products->isEmpty())
        <p>Aucun produit dans cette catégorie.</p>  
    @else
        <ul>
            @foreach($category->products as $product)
                <li>{{ $product->name }}</li>
            @endforeach
        </ul>
    @endif

@endsection