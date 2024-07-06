@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <h1 class="text-center mb-5 fs-1">Dashboard Agriculteur</h1>

    @if($hasStock == false)
    <div class="alert alert-info text-center">
        Aucun stock disponible
    </div>
    <div class="text-center">
        <a href="{{ route('stocks.create') }}" class="btn btn-primary">Ajouter un nouveau stock</a>
    </div>
    @else
    <!-- Tableau pour les écrans moyens et plus grands -->
    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Produit</th>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stock as $item)
                <tr>
                    <td>{{ Str::limit($item->product->name, 15) }}</td>
                    <td>{{ Str::limit($item->description, 50) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td class="d-flex">
                        <a href="{{ route('stocks.edit', $item->id) }}" class="btn btn-warning btn-sm flex-fill mx-1">Modifier <i class="fas fa-edit"></i></a>
                        <form action="{{ route('stocks.destroy', $item->id) }}" method="POST" class="d-inline flex-fill mx-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">Supprimer <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Cartes pour les écrans plus petits -->
    <div class="d-block d-md-none">
        <div class="row">
            @foreach ($stock as $item)
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Produits :</strong> {{ $item->product->name }}</h5>
                        <p class="card-text"><strong>Description:</strong> {{ Str::limit($item->description, 20) }}</p>
                        <p class="card-text"><strong>Quantité:</strong> {{ $item->quantity }}</p>
                        <p class="card-text"><strong>Prix:</strong> {{ $item->price }} €</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('stocks.edit', $item->id) }}" class="btn btn-warning btn-sm flex-fill">Modifier <i class="fas fa-edit"></i></a>
                            <form action="{{ route('stocks.destroy', $item->id) }}" method="POST" class="d-inline flex-fill">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">Supprimer <i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

