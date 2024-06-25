@extends('layouts.app')

@section('content')

<h1>Produits de la catégorie : {{ $category->name }}</h1>


@foreach ($products as $product)
    <p>{{ $product->name }}</p>
@endforeach

@endsection