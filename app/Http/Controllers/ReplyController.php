<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class ReplyController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::findorFail($request->post_id);

        $reply = new Reply;

        $reply->text = $request->text;
        $reply->user_id = Auth::id();
        $reply->post_id = $post->id;
        $reply->likes = 0;
        $reply->save();

        return redirect()->route('post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $Reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $Reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $Reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $Reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $Reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $Reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $Reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $Reply)
    {
        //
    }
}
