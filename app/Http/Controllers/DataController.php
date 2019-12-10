<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;

class DataController extends Controller
{
    public function create() {

        return view('create');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'data' => 'required|max:255'
        ]);

        $a = new Posts;
        $a->text = $validatedData['data'];
        $a->save();
        session()->flash('message', 'Data entered.');
        return redirect()->route('data.create');

    }
}
