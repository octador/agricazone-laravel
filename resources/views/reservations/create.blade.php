@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="card" style="width: 100%; max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h1>Créer Réservation</h1>
        </div>
        <div class="card-body text-center">
            <svg width="100" height="100" viewBox="0 0 16 16" class="bi bi-box-seam mb-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8.5.134a1 1 0 0 0-1 0l-6 3.46A1 1 0 0 0 1 4.461V10.5a1 1 0 0 0 .5.866l6 3.46a1 1 0 0 0 1 0l6-3.46A1 1 0 0 0 15 10.5V4.46a1 1 0 0 0-.5-.866l-6-3.46zM2.5 5.13v4.74L8 13.548V8.807L2.5 5.13zM8 7.193l5.5 3.678V5.13L8 1.807v5.386zm1-.928l4.5-2.9L8 1.193 3.5 3.365 8 6.265z" />
            </svg>
            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <div>
                    <h3>Produits : {{ $product->name }}</h3>
                    <h3>Quantitées disponibles : {{ $stock->quantity }} kg</h3>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="status_id" value="3">
                    <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                    <input type="hidden" name="price" value="{{ $stock->price }}">

                    <div class="form-group">
                        <label for="collection_id">Point de vente</label>
                        <select name="collection_id" id="collection_id" class="form-control">
                            @foreach($collection_ids as $collection_id)
                            <option value="{{ $collection_id->id }}">{{ $collection_id->city }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantité</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" max="{{ $stock->quantity }}" min="1">
                    </div>

                    <p>Prix : {{ $stock->price }} €/kg</p>
                    <p>Prix total : <span id="prixTotal"></span></p>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Créer une nouvelle réservation</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('prixTotal').textContent = 0 + ' €';
    // Écoute les événements d'entrée sur le champ "Quantité" pour met à jour le prix total en conséquence
    document.getElementById('quantity').addEventListener('input', function() {
        // Convertit la valeur saisie en entier
        let quantity = parseInt(this.value);

        // Récupère le prix du produit depuis l'input hidden
        let price = parseFloat(document.querySelector('input[name="price"]').value);
        // Calcule le prix total en multipliant la quantité par le prix
        let total = (quantity * price).toFixed(2);
        // Affiche le prix total dans l'élément avec l'id "prixTotal"
        document.getElementById('prixTotal').textContent = total
    });
</script>


@endsection