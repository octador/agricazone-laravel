@extends('app')

@section('content') 

<h1>Create Reservation</h1>



<form action="{{ route('reservations.store') }}" method="POST">
    @csrf



    

    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" class="form-control">
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Create Reservation</button>
    </div>
</form>

@endSection
