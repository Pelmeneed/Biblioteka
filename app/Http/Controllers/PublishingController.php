<?php

namespace App\Http\Controllers;

use App\Models\Publishing;
use Illuminate\Http\Request;

class PublishingController extends Controller
{

    public function index()
    {
        $publishings = Publishing::orderBy('name')->get();
        return view('items.publishings.index', compact('publishings'));
    }


    public function create()
    {
        return view('items.publishings.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200'
        ]);

        Publishing::create($request->all());
        return redirect()->route('items.publishings.index')->with('success', 'Издательство успешно добавлено');
    }


    public function edit(Publishing $publishing)
    {
        return view('items.publishings.edit', compact('publishing'));
    }


    public function update(Request $request, Publishing $publishing)
    {
        $request->validate([
            'name' => 'required|string|max:200'
        ]);

        $publishing->update($request->all());
        return redirect()->route('items.publishings.index')->with('success', 'Издательство успешно обновлено');
    }


    public function destroy(Publishing $publishing)
    {
        $publishing->delete();
        return redirect()->route('items.publishings.index')->with('success', 'Издательство успешно удалено');
    }
}
