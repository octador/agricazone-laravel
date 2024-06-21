@extends('app')

@section('title', 'Stock Search')

@section('content')

<h1>Stock Search Results</h1>

<ul>
    @foreach($stocks as $stock)
        <li>
            <a href="{{ route('reservations.create', $stock->id) }}">
                Description: {{ $stock->description }} - Quantity: {{ $stock->quantity }} - Price: ${{ $stock->price }} - Product ID: {{ $stock->product_id }} - User ID: {{ $stock->user_id }}
                
                @foreach($products as $product)
                    @if($product->id == $stock->product_id)
                        - Product: {{ $product->name }}
                    @endif
                @endforeach
                
                @foreach($users as $user)
                    @if($stock->user_id == $user->id)
                        - User Name: {{ $user->name }}
                    @endif
                @endforeach
            </a>
        </li>
    @endforeach
</ul>

@endsection
