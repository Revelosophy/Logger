@extends('layouts.template')


@section('title')
<h1>Hello!</h1>
@endsection

@section('content')
<h2>Welcome to the site!</h2>
<ul>
    @foreach ($posts as $post)
    <li>{{$post->text}}</li>
    <br/>
    @endforeach
</ul>
<a href="{{route('data.create')}}">Create post</a>
@endsection