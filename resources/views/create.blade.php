@extends('layouts.app')
@section('content')
    <h1>Create a post</h1>
    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf
        <p><input type ="text" name="text"></p>
        <p><input type="file" name="image"></p>
        <input type="submit" value="Submit">
    </form>
@endsection