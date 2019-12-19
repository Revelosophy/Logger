<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Reply;
use App\Post;
use Auth;
use Storage;

class ReplyController extends Controller
{

    public function __construct() {
        $this->middleware('auth');

    }
   
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'text' => 'required|max:255',
        ]);

        $post = Post::findorFail($request->post_id);

        $reply = new Reply;
        $reply->text = $request->text;
        $reply->user_id = Auth::id();
        $reply->post_id = $post->id;
        $reply->likes = 0;
        $reply->save();

        $replyResponse = Reply::findorFail($reply->id);

        if ($request->ajax()) {
            return $replyResponse;
        }
    }


    public function edit(Request $request)
    {
        $reply = Reply::findorFail($request->reply_id);
        $this->authorize('update', $reply);
        return view('comment_edit', ['reply'=>$reply]);
    }


    public function update(Request $request)
    {
        $reply = Reply::findorFail($request->reply_id);
        $this->authorize('update', $reply);
        $reply->text = $request->new_reply;
        $reply->save();
        return redirect()->route('post.index')->with('message', 'Reply updated!');
    }

    public function delete(Request $request) {
        $reply = Reply::findorFail($request->reply_id);
        $this->authorize('delete', $reply);
        $reply->delete();

        return redirect()->route('post.index')->with('message', 'Reply deleted!');

    }
}
