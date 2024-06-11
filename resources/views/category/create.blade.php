@extends('layouts.app')

@section('content')
    <h1>Ajouter un Post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title">
        <br>
        <label for="content">Contenu :</label>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <br>
        <button type="submit">Ajouter</button>
    </form>
@endsection
