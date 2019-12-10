@extends('layouts.template')


@section('title')
<h1>Lorem ipsum {{$name}}</h1>
@endsection

@section('content')
<h2>Welcome to the site!</h2>
<a href="{{route('data.create')}}">Make some data</a>
@endsection