@extends('app')

@section('title' , 'Index')

@section('content')

<h1>La page index</h1>
<h1>Reservations</h1>
@foreach ($reservations as $reservation)
    <li>{{ $reservation }}</li>
    
@endforeach

@endSection