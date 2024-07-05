@extends('layouts.app')

@section('content')


<h1>Dashboard client</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

    @foreach($categories as $category)
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-lg font-medium mb-2">{{ $category->name }}</h3>
            <div class="h-40 w-full bg-gray-200 rounded-lg"></div>
            <a href="{{route('product.search', $category->id)}}" class="btn btn-primary">Voir</a>
        </div>
    @endforeach

</div>
@endsection

