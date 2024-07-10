@extends('layouts.app')

@section('content')

<h1 class="text-center mb-5 mt-5 fs-1">Dashboard client</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-5 flex-wrap">

    @foreach($categories as $category)
    <div class="bg-white rounded-lg shadow p-4 flex flex-col">

        <img src="https://via.placeholder.com/150x100?text={{ $category->name }}" alt="{{ $category->name }} placeholder" class="w-full h-40 object-cover rounded-t-lg mb-2" />

        <h3 class="text-lg font-medium mb-2 text-center">{{ $category->name }}</h3>
        <div class=" d-flex justify-content-center">

            <a href="{{ route('product.search', $category->id) }}" class="btn bg-customGreen-500 text-white hover:bg-customGreen-600  w-50">Voir les produits</a>
        </div>
    </div>
    @endforeach

</div>
@endsection