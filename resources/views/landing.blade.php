@extends('layouts.app') 
@section('content')

@if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
@endif

<div class="card bg-dark text-white" style="padding:80px;">
    <h2>Welcome back, {{Auth::user()->name}}!</h2>
</div>

@foreach ($posts as $post)
<div class="card border-dark text-dark bg-secondary" style="margin:20px;">
    <div class="card border-dark text-dark" style="margin:20px;">
        <h5 class="card-header bg-dark text-white">Posted by {{$post->poster}} at {{$post->created_at}}</h5> 
        
        @if (!is_null($post->image_link))
        <img class="card-img-top" style="width:50%; margin-left:auto; margin-right:auto; margin-top:20px;  display:block;" src="/images/{{$post->image_link}}" alt="Responsive image"> 
        @endif

        <div class="card-body">
            <p class="card-text">{{$post->text}}</p>
        </div>
        <form class="form-group" method="POST" action="{{ route('reply.store') }}">
            @csrf
            <div class="form-group" style="margin:10px;">
                <input class="form-control form-control-lg" type="text" placeholder="Reply to post.." name="text">
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="text-right" style="margin:10px;">
                <a class="btn btn-outline-dark">Like</a>
                <input type="submit" class="btn btn-outline-dark" value="Reply to {{$post->poster}}"></input>
            </div>
        </form>

        @can('delete', $post)
        <form class="text-right" style="margin:10px;" method="POST" action="{{route ('post.delete') }}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="submit" class="btn btn-outline-dark" value="Delete"></input>
        </form>
        @endcan

        @can('update', $post)
        <form class="text-right" style="margin:10px;" method="GET" action="{{route ('post.edit') }}">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="submit" class="btn btn-outline-dark" value="Edit"></input>
        </form>
        @endcan
    
    </div>

    @foreach($post->replies as $reply)
    <div class="card border-dark mb-3 text-dark" style="max-width:50%; margin:20px;">
        <div class="card-header">Reply from {{DB::table('users')->where('id',$reply->user_id)->value('name')}} at {{$reply->created_at}}</div>
        <div class="card-body">
            {{ $reply->text }}
            
            @can('update', $reply)
            <form class="text-right" style="margin:10px;" method="GET" action="{{route ('reply.edit') }}">
            @csrf
            <input type="hidden" name="reply_id" value="{{ $reply->id }}">
            <input type="submit" class="btn btn-outline-dark" value="Edit"></input>
            </form>
            @endcan

        </div>
    </div>
    @endforeach
</div>

@endforeach 
{{ $posts->links() }}
<a href="{{route('post.create')}}">Create post</a> 
@endsection