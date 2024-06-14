@extends('app')
@section('title' , 'Index')
@section('content')

<h1>La page index</h1>

<h1>Categories</h1>
<form action="{{ route('categories.search') }}" method="get">
    <label for="category">Choisissez une catégorie :</label>
    <select name="category" id="category">
        @foreach($categories as $category)
        <option value="{{ $category->slug }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <button type="submit">Rechercher</button>
</form>


@endsection