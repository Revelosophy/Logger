<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{

    public function index() {

        $data = Post::all();
        return view ('landing', ['posts' => $data]);

    }


    public function create() {

        return view('create');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'data' => 'required|max:255'
        ]);

        $a = new Post;
        $a->text = $validatedData['data'];
        $a->poster = Auth::user()->name;
        $a->save();
        session()->flash('message', 'Data entered.');
        return redirect()->route('data.index');

    }
}
