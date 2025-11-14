<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;


class AuthorController extends Controller
{


    public function index()
    {
        $authors = Author::orderBy('lastname')->get();
        return view('items.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('items.authors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lastname' => 'required|string|max:100',
            'firstname' => 'required|string|max:100',
            'patronymic' => 'nullable|string|max:100',
        ]);

        Author::create($validated);

        return redirect()->route('items.authors.index')
            ->with('success', 'Автор успешно добавлен');
    }

    public function edit(Author $author)
    {
        return view('items.authors.edit', compact('author'));
    }


    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'lastname' => 'required|string|max:100',
            'firstname' => 'required|string|max:100',
            'patronymic' => 'nullable|string|max:100',
        ]);

        $author->update($validated);

        return redirect()->route('items.authors.index')
            ->with('success', 'Автор успешно обновлен');
    }


    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('items.authors.index')
            ->with('success', 'Автор успешно удален');
    }
}
