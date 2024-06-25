@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="card" style="width: 100%; max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h1>Modifier Réservation</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="product">Produit</label>
                    <input type="text" id="product" class="form-control" value="{{ $product->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantité</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="{{ $reservation->quantity }}" min="1" required>
                </div>

                <div class="form-group">
                    <label for="price">Prix unitaire (€/kg)</label>
                    <input type="text" id="price" name="price" class="form-control" value="{{ $stock->price }}" readonly>
                </div>

                <div class="form-group">
                    <label for="total_price">Prix total (€)</label>
                    <input type="text" id="total_price" name="total_price" class="form-control" value="{{ number_format($reservation->total_price, 2) }}" readonly>
                </div>

                <div class="form-group">
                    <label for="collection_id">Point de vente</label>
                    <select name="collection_id" id="collection_id" class="form-control">
                        @foreach($collections as $collection)
                        <option value="{{ $collection->id }}" {{ $collection->id == $reservation->collection_id ? 'selected' : '' }}>{{ $collection->city }} {{ $collection->postalcode }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Enregistrer les modifications</button>
            </form>

            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-block">Supprimer la réservation</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('quantity').addEventListener('input', function() {
        let quantity = parseInt(this.value);
        let price = parseFloat(document.getElementById('price').value);
        let total = (quantity * price).toFixed(2);
        document.getElementById('total_price').value = total;
    });
</script>
@endsection