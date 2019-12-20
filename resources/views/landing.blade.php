@extends('layouts.app') 
@section('content')

@if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
@endif

@if (Session::has('post_error'))
        <div class="alert alert-danger">
            {{ Session::get('post_error') }}
        </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card bg-info text-black" style="padding:50px;">
    <h2>Welcome back, {{Auth::user()->name}}!</h2>
    @if  (Auth::user()->is_admin == 1)
        <h4>You have administrator privilages.</h4>
    @endif
    <hr/>
    <h4>You have {{ count(Auth::user()->posts) }} post(s).</h4>
    <h4> You've replied {{ count(Auth::user()->replies) }} time(s).</h4>
</div>

<button type="button" class="btn btn-success tn-lg btn-block" data-toggle="modal" data-target="#postModal" style="margin-top:20px; padding: 10px">
  Create a post
</button>

<div style="margin:20px;">
    {{ $posts->links() }}
</div>


@foreach ($posts as $post)
<div class="card border-dark j" style="margin:20px;">
    <div class="card border-dark text-dark" style="margin:20px;">
        <h5 class="card-header bg-dark text-white">Posted by {{$post->poster}} at {{$post->created_at}}</h5> 
        
        @if (!is_null($post->image_link))
        <img class="card-img-top" style="width:50%; margin-left:auto; margin-right:auto; margin-top:20px;  display:block;" src="/images/{{$post->image_link}}" alt="Responsive image"> 
        @endif

        <div class="card-body">
            <p class="card-text">{{$post->text}}</p>
        </div>


        <form id ="postreply" class="form-group" method="POST" action="#">
            @csrf
            <div class="form-group" style="margin:10px;">
                <input class="form-control form-control-lg" type="text" placeholder="Reply to post.." name="text">
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="text-right" style="margin:10px;">
                <input id="replypost" type="submit" class="btn btn-outline-dark reply" value="Reply to {{$post->poster}}"></input>
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

            @can('delete', $reply)
        <form class="text-right" style="margin:10px;" method="POST" action="{{route ('reply.delete') }}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="reply_id" value="{{ $reply->id }}">
            <input type="submit" class="btn btn-outline-dark" value="Delete"></input>
        </form>
        @endcan

        </div>
    </div>
    @endforeach
</div>


@endforeach 

<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="postModalLabel">Create a post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf
            <p><input class ="form-control-lg" placeholder="Text goes here..." type ="text" name="text" style="width:100%;"></p>
            <hr/>
            <p>You can also upload an image</p>
            <p><input type="file" name="image"></p>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="Create post"></input>
      </div>
      </form>
    </div>
  </div>
</div>


<div style="margin:20px;">
    {{ $posts->links() }}
</div>

@endsection