<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Intervention;
use Illuminate\Http\Request;
use App\Post;
use App\Image;
use Auth;
use Storage;

class PostController extends Controller
{

    public function index() {

        $data = Post::paginate(5);
        return view ('landing', ['posts' => $data]);

    }


    public function create() {

        return view('create');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'text' => 'required|max:255',
            'image' => 'sometimes|image|mimes:jpg,jpeg,bmp,svg,png'
        ]);
        
        $newPost = new Post;
        $newPost->text = $validatedData['text'];
        $newPost->poster = Auth::user()->name;
        $newPost->user_id = Auth::user()->id;
    

        if($request['image']) {

            $imageName = time().'.'.$request->image->extension();
            $newPost->image_link = $imageName;
            $image_file = $request->file('image');
            $image_resize = Intervention::make($image_file->getRealPath());
            $image_resize->resize(750, 470);
            $image_resize->save(public_path('/images/') . $imageName);

            // $request->image->move(public_path('images'), $imageName);
        }

        $newPost->save();

        return redirect()->route('post.index')->with('message', 'Post created!');

    }

    public function destroy(Request $request) {
        
        $post = Post::findorFail($request->post_id);
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('post.index')->with('message', 'Post deleted!');
    }

    public function edit(Request $request) {
        $post = Post::findorFail($request->post_id);
        $this->authorize('update', $post);
        return view('edit', ['post'=>$post]);
    }


    public function update(Request $request) {
        $post = Post::findorFail($request->post_id);
        $this->authorize('update', $post);
        $post->text = $request->new_post;
        $post->save();
        return redirect()->route('post.index')->with('message', 'Post updated!');

    }
}
