@extends('layouts.app')

@section('title', 'Index')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="card" style="width: 100%; max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h1>La page index</h1>
        </div>
        <div class="card-body text-center">
            <svg width="100" height="100" viewBox="0 0 16 16" class="bi bi-calendar mb-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1zm1-1h12a1 1 0 0 1 1 1v1H1V4a1 1 0 0 1 1-1z" />
            </svg>
            <h1>Reservations</h1>

            <ul class="list-unstyled">
                @foreach ($reservations as $reservation)
                <div class="card-body">
                    <li>numero de reservation : {{$reservation->id}}</li>
                    <li>Quantitée : {{ $reservation->quantity }} kg</li>
                    <li>prix total :{{ $reservation->total_price }}</li>
                    <li>status:
                        @if($status_name=="pending")
                            <span class="badge bg-secondary text-dark text-white">En cours</span>
                         @elseif($status_name=="validate")
                            <span class="badge bg-success">Validé</span>
                        @elseif($status_name=="cancel")
                            <span class="badge bg-danger">Annulé</span>
                        @endif
                        </li>
                </div>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection