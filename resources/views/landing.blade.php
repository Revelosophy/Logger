@extends('layouts.app')


@section('title')
<h1>Social Media</h1>
@endsection

@section('content')
<h2>Welcome to the site!</h2>
<h2>Post below</h2>
<ul>
    @foreach ($posts as $post)
    <li>{{$post->text}} <br/><br/> {{$post->created_at}} <br/><br/> Posted by: {{$post->poster}}</li><hr/>
    @endforeach
</ul>
<a href="{{route('data.create')}}">Create post</a>
@endsection