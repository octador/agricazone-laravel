@extends('app')
@section('title' , 'Index')
@section('content')



<h1>La page index</h1>
<h1>Categories</h1>

@foreach ($categories as $category)

<a href="{{route('product.search', $category->id)}}">{{$category->name}}"</a>
@endforeach

@endsection