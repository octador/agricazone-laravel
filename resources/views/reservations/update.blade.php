@extends('layouts.app')

@section('content')

<p>Dernière mise à jour: {{ \Carbon\Carbon::parse($reservation->updated_at)->format('d/m/Y H:i:s') }}</p>




@endsection