@extends('app')
@section('title' , 'Ajouter un categories')
@section('content')



<h1>Ajouter un categories</h1>

<form action="{{route('category.store')}}" method="post">
    @csrf

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </ul>
    </div>
    @endif
    <input type="text" name="name" value="{{old('name')}}">
    <button>Ajouter</button>
</form>

@endsection