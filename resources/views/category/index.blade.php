@extends('app')
@section('title' , 'Index')
@section('content')

<h1>La page index</h1>

<h1>Categories</h1>
    <table>
        <thead>
            <tr>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endsection