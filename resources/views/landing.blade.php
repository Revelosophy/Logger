@extends('layouts.app') 
@section('content')

@if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
@endif

<div class="card bg-info text-black" style="padding:50px;">
    <h2>Welcome back, {{Auth::user()->name}}!</h2>
    <h3>You have {{ count(Auth::user()->posts) }} post(s)</h3>
    <h3> You've replied {{ count(Auth::user()->replies) }} time(s)</h3>
</div>

<!-- <a role="button" class="btn btn-warning btn-lg btn-block" style="margin:20px;" href="{{route('post.create')}}">Create a post</a> -->
<button type="button" class="btn btn-primary tn-lg btn-block" data-toggle="modal" data-target="#exampleModal" style="margin-top:20px; padding: 10px">
  Create a post
</button>


@foreach ($posts as $post)
<div class="card border-dark" style="margin:20px;">
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
        <span>
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

        </span>
    
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create a post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf
            <p><input type ="text" name="text"></p>
            <p>You can also upload an image</p>
            <p><input type="file" name="image"></p>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Create post"></input>
      </div>
      </form>
    </div>
  </div>
</div>


{{ $posts->links() }}
<!-- <a href="{{route('post.create')}}">Create post</a>  -->

@endsection