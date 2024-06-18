@extends('app')

@section('title' , 'Index')

@section('content')

<h1>La page index</h1>
<h1>Produits</h1>

@forelse ($products as $product)



@endsection<