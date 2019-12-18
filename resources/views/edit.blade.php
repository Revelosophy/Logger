@extends('layouts.app')
@section('content')

<h1>Edit post</h1>

<div class="card border-dark text-dark bg-secondary" style="margin:20px;">
    <div class="card border-dark text-dark" style="margin:20px;">
        <h5 class="card-header bg-dark text-white">Posted by {{$post->poster}} at {{$post->created_at}}</h5> 
        
        @if (!is_null($post->image_link))
        <img class="card-img-top" style="width:50%; margin-left:auto; margin-right:auto; margin-top:20px;  display:block;" src="/images/{{$post->image_link}}" alt="Responsive image"> 
        @endif

        <form method="POST" style="padding:10px; margin:20px;" action="{{ route('post.update') }}">
            <div class="form-group">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <textarea class="from-control form-control-lg" name="new_post" rows="2" style="width:100%;">{{$post->text}}</textarea>
                <input type="submit" class="btn btn-outline-dark" value="Save Chnages"></input>
            </div>
        </form>
    </div>
    @endsection