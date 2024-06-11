@extends('layouts.app')

@section('content')
    <h1>Liste des Posts</h1>

    <a href="{{ route('posts.create') }}" class="btn btn-primary">Ajouter un Post</a>

    <ul>
        @foreach ($posts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>
@endsection
