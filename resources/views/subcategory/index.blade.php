@extends('app')


@section('content')

    @foreach($categories as $category)
        <ul>
            <li><a href="{{ action('SubCategoryController@show', [$category->CategoryId]) }}">{{ $category->Category }}</a></li>
        </ul>
    @endforeach

@endsection