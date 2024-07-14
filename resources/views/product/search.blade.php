@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-5 container">


    <div class="card border-2 border-customGreen-500 " style="width: 100%; max-width: 600px;">

        <div class="card-header bg-customGreen-500 text-white text-center fs-1">
            <h1 class="text-center ">Produits de la catégorie : {{ $category->name }}</h1>
        </div>


        <div class="row justify-content-center mt-3 ">
            @if($products->isEmpty())
            <div class="alerttext-customGreen-500 text-center w-50" role="alert">
                <h2>Aucun produit de cette catégorie.</h2>
            </div>
            @endif
            @foreach ($products as $product)
            <div class="col-md-4 mb-3 ">
                <div class="card border-2 border-customGreen-500">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-card-image mb-2" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        <h5 class="card-title ">{{ $product->name }}</h5>
                        <a href="{{ route('reservations.create', $product->id) }}" class="btnCustom mt-3">Détails</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection