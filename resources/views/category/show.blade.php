@extends('app')

@section('content')

    <h1>Détails du Post</h1>

    <p><strong>nom :</strong> {{ $category->title }}</p>

    {# <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Modifier</a> #}

    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
@endsection
