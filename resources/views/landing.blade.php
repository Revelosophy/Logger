@extends('layouts.app')

@section('content')
<h2>Welcome back, {{Auth::user()->name}}! </h2>
<ul>
    @foreach ($posts as $post)
    <div class="card" style="margin:20px;">
        <h5 class="card-header">Posted by {{$post->poster}} at {{$post->created_at}}</h5>
        <div class="card-body">
            <p class="card-text">{{$post->text}}</p>
            <div class="text-right">
                <a href="#" class="btn btn-outline-dark">Like</a>
                <a href="#" class="btn btn-outline-dark">Reply</a>
            </div>
        </div>
        <form method="POST" action="{{ route('reply.store') }}">
            @csrf
            <p><input type="text" name="text"></p>
            <input type="hidden" name ="post_id" value="{{ $post->id }}">
            <input type="submit" value="submit">
        </form>
    </div>
    @endforeach
</ul>
<a href="{{route('post.create')}}">Create post</a>
@endsection