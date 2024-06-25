@extends('layouts.app')
@section('title' , 'Index')
@section('content')



<h1>La page index</h1>
<h1>Categories</h1>

<div class="d-flex flex-wrap gap-3">
    @foreach ($categories as $category)
    <div class="card border-1 rounded-3 align-items-center text-center">
        <div class="card-body flex ">
            <h5 class="card-title">{{$category->name}}</h5>
            <a href="{{route('stocks.search', $category->id)}}" class="btn flex flex-column"> <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
            </svg>Voir</a>
        </div>
    </div>
    @endforeach
</div>

@endsection