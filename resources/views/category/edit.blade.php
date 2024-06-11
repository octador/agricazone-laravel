@extends('app')

@section('content')
    <h1>Modifier le Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" value="{{ $post->title }}">
        <br>
        <label for="content">Contenu :</label>
        <textarea name="content" id="content" cols="30" rows="10">{{ $post->content }}</textarea>
        <br>
        <button type="submit">Modifier</button>
    </form>
@endsection
