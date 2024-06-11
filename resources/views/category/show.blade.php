@extends('layouts.app')

@section('content')
    <h1>Détails du Post</h1>

    <p><strong>Titre :</strong> {{ $post->title }}</p>
    <p><strong>Contenu :</strong> {{ $post->content }}</p>

    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Modifier</a>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
@endsection
