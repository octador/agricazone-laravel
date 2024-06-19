@extends('app')
@section('title', 'Stock Search')
@section('content')

<h1>Stock Search Results</h1>

<ul>
    @foreach($stocks as $stock)
    <li>
        {{ $stock->description }} - Quantity: {{ $stock->quantity }} - Price: ${{ $stock->price }} - Product ID: {{ $stock->product_id }} - User ID: {{ $stock->user_id }} -

        @foreach($users as $user)
            @if($stock->user_id == $user->id)
        - User Name: {{$user->name}}

        -user id : {{$user->id}}
        @endif
        @endforeach

        @endforeach
    </li>



</ul>

@endsection