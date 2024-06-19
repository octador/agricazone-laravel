@extends('app')
@section('title', 'Stock Search')
@section('content')

<h1>Stock Search Results</h1>

<ul>
    @foreach($stocks as $stock)
    <a href="{{ route('reservations.create', $stock->id) }}">
        @foreach($products as $product)
        produit-{{$product->name}} 
        @endforeach
        
        
        description-{{ $stock->description }} - Quantity: {{ $stock->quantity }} - Price: ${{ $stock->price }} - Product ID: {{ $stock->product_id }} - User ID: {{ $stock->user_id }} -

        @foreach($users as $user)
            @if($stock->user_id == $user->id)
        - User Name: {{$user->name}}

        -user id : {{$user->id}}
        @endif
        @endforeach

        
        @endforeach
</a>



</ul>

@endsection