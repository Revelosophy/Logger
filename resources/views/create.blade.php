@extends('layouts.app')
@section('content')
    <h1>Create a post</h1><br/>
    <h3>Write something here...</h3>
    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf
        <p><input type ="text" name="text"></p>

        <!-- <br/>
        <hr>
        <br/>
        <br/> -->

        <h3>You can also upload an image</h3>
        <p><input type="file" name="image"></p>
        <input type="submit" value="Submit">
    </form>

@endsection