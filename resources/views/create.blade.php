@extends('layouts.app')
@section('content')
    <h1>Create a post</h1>
    <form method="POST" action="{{ route('post.store') }}">
        @csrf
        <p><input type ="text" name="data"></p>
        <input type="submit" value="Submit">
    </form>
@endsection