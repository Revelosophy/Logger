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
        $newPost->poster_id = Auth::user()->id;
    

        if($request['image']) {

            $imageName = time().'.'.$request->image->extension();
            $newImage = new Image;
            $newImage->link = '/images/' . $imageName;
            $newImage->uploader_id = Auth::user()->id;
            $newImage->size = $request->image->getSize();
            $newImage->save();
            
            $image_file = $request->file('image');
            $image_resize = Intervention::make($image_file->getRealPath());
            $image_resize->resize(750, 470);
            $image_resize->save(public_path('/images/') . $imageName);

            // $request->image->move(public_path('images'), $imageName);
            $newPost->image_id = $newImage->id;
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


}
