<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publishing;
use App\Models\TypeOfBook;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::with(['author', 'publishing', 'typeOfBook'])->get();
        return view('items.books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::orderBy('lastname')->get();
        $publishings = Publishing::orderBy('name')->get();
        $types = TypeOfBook::orderBy('name')->get();

        return view('items.books.create', compact('authors', 'publishings', 'types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'type_of_book_id' => 'required|exists:type_of_books,id',
            'author_id' => 'required|exists:authors,id',
            'publishing_id' => 'required|exists:publishings,id',
            'year_of_publish' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'count_of_sheets' => 'required|integer|min:1',
            'count_of_items' => 'required|integer|min:1',
        ]);

        Book::create($validated);

        return redirect()->route('items.books.index')
            ->with('success', 'Книга успешно добавлена');
    }


    public function edit(Book $book)
    {
        $authors = Author::orderBy('lastname')->get();
        $publishings = Publishing::orderBy('name')->get();
        $types = TypeOfBook::orderBy('name')->get();

        return view('items.books.edit', compact('book', 'authors', 'publishings', 'types'));
    }


    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'type_of_book_id' => 'required|exists:type_of_books,id',
            'author_id' => 'required|exists:authors,id',
            'publishing_id' => 'required|exists:publishings,id',
            'year_of_publish' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'count_of_sheets' => 'required|integer|min:1',
            'count_of_items' => 'required|integer|min:1',
        ]);

        $book->update($validated);

        return redirect()->route('items.books.index')
            ->with('success', 'Книга успешно обновлена');
    }


    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('items.books.index')
            ->with('success', 'Книга успешно удалена');
    }
}
