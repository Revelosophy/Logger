@extends('layouts.app')
@section('content')

<h1>Edit reply</h1>

<div class="card border-dark mb-3 text-dark" style="max-width:50%; margin:20px;">
        <div class="card-header">Reply from {{DB::table('users')->where('id',$reply->user_id)->value('name')}} at {{$reply->created_at}}</div>
        <div class="card-body">
        <form method="POST" style="padding:10px; margin:20px;" action="{{ route('reply.update') }}">
            <div class="form-group">
                @csrf
                <input type="hidden" name="reply_id" value="{{ $reply->id }}">
                <textarea class="from-control form-control-lg" name="new_reply" rows="2" style="width:100%;">{{$reply->text}}</textarea>
                <input type="submit" class="btn btn-outline-dark" value="Save Chnages"></input>
            </div>
        </form>

        </div>
</div>
@endsection

