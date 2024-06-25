@extends('layouts.app')

@section('content')
<h1>Edit Category</h1>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('categories.update', $category->slug) }}" method="POST">
    @csrf
    @method('post')
    <div>
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required>
    </div>
    <button type="submit">Update Category</button>
</form>
@endsection