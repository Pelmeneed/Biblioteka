<?php

namespace App\Http\Controllers;

use App\Models\TypeOfBook;
use Illuminate\Http\Request;

class TypeOfBookController extends Controller
{
    public function index()
    {
        $types = TypeOfBook::orderBy('name')->get();
        return view('items.types-of-books.index', compact('types'));
    }

    public function create()
    {
        return view('items.types-of-books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150'
        ]);

        TypeOfBook::create($request->all());
        return redirect()->route('items.types-of-books.index')->with('success', 'Тип издания успешно добавлен');
    }

    public function edit(TypeOfBook $typesOfBook)
    {
        return view('items.types-of-books.edit', compact('typesOfBook'));
    }

    public function update(Request $request, TypeOfBook $typesOfBook)
    {
        $request->validate([
            'name' => 'required|string|max:150'
        ]);

        $typesOfBook->update($request->all());
        return redirect()->route('items.types-of-books.index')->with('success', 'Тип издания успешно обновлен');
    }

    public function destroy(TypeOfBook $typesOfBook)
    {
        $typesOfBook->delete();
        return redirect()->route('items.types-of-books.index')->with('success', 'Тип издания успешно удален');
    }
}
