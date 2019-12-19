@extends('layouts.app') 
@section('content')


@if (Session::has('message'))
        <div class="alert alert-danger">
            {{ Session::get('message') }}
        </div>
@endif


<h1>Admin Dashboard</h1>


<table class="table" style="margin:20px;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Is Admin?</th>
    </tr>
  </thead>

@foreach($accounts as $account)
<thread>
<tr>
    <th scope="row">{{$account->id}}</th>
    <td>{{$account->name}}</td>
    <td>{{$account->email}}</td>
    <td>{{$account->is_admin}}</td>
    <td>
        <form method="POST" action="{{ route('user.delete') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $account->id }}">
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Delete"></input>
        </form>
    </td>

</tr>
</thread>
@endforeach

@endsection