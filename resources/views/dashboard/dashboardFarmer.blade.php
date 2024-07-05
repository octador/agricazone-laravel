@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
 
    @if($hasStock==false)
        <p>Aucun stock disponible</p>
        <a href="{{ route('stocks.create') }}" class="btn btn-primary"> Ajouter un nouveau stock</a>
    @endif


    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($stock as $item)
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-medium mb-2">{{ $item->product->name }}</h3>
                <p class="text-gray-600">Quantité: {{ $item->quantity }}</p>
                <p class="text-gray-600">Prix: {{ $item->price }}</p>
                <a href="{{ route('stocks.edit', $item->id) }}" class="btn btn-primary">Modifier le stock <i class="fas fa-edit"></i"></a>

                <form action="{{ route('stocks.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer le stock <i class="fas fa-trash"></i></button>
                </form>
                
            </div>
        @endforeach
    </div>
</div>

@endsection
