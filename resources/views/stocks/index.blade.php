@extends('layouts.app')

@section('content')



    <div class="container">
        <h1>Vos stocks</h1>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    @foreach ($stocks as $stock)
                        <th>{{ $stock->id }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Produit</td>
                    @foreach ($stocks as $stock)
                        <td>
                            @foreach ($products as $product)
                                @if ($product->id == $stock->product_id)
                                    {{ $product->name }}
                                @endif
                            @endforeach
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>Description</td>
                    @foreach ($stocks as $stock)
                        <td>{{ $stock->description }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Quantité</td>
                    @foreach ($stocks as $stock)
                        <td>{{ $stock->quantity }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Prix</td>
                    @foreach ($stocks as $stock)
                        <td>{{ $stock->price }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
<a href="{{ route('stocks.create') }}" class="btn btn-primary"> Creer un nouveau stock</a>
@endsection