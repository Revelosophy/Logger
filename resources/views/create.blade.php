@extends('layouts.template')
@section('title')
    <h1>Create a post</h1>
@endsection
@section('content')
    <form method="POST" action="{{ route('data.store') }}">
        @csrf
        <p>Data: <input type ="text" name="data"></p>
        <input type="submit" value="Submit">
    </form>
@endsection