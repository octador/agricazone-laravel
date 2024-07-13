@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-5 container">
    <div class="card border-customGreen-500">
        <div class="card-header bg-customGreen-500 text-white text-center fs-1">
            <h1>Dashboard client</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-5 flex-wrap p-4">
            @foreach($categories as $category)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col">
                <img src="https://via.placeholder.com/150x100?text={{ $category->name }}" alt="{{ $category->name }} placeholder" class="w-full h-40 object-cover rounded-t-lg mb-2" />
                <h3 class="text-lg font-medium mb-2 text-center">{{ $category->name }}</h3>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('product.search', $category->id) }}" class="btn bg-customGreen-500 text-white hover:bg-customGreen-600 w-50">Voir les produits</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-end p-3">
        @if ($categories->hasPages())
                {{ $categories->links() }}
            @else
                <p class="text-center">Tous les éléments sont affichés</p>
            @endif
        </div>
    </div>
</div>
@endsection