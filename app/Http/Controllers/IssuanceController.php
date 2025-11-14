<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reader;
use App\Models\BooksAction;
use Illuminate\Http\Request;

class IssuanceController extends Controller
{
    public function index()
    {
        $readers = Reader::where('can_get_books', true)
            ->orderBy('lastname')
            ->get();

        $books = Book::with(['author', 'publishing', 'typeOfBook'])
            ->get()
            ->map(function($book) {
                $issuedCount = BooksAction::where('book_id', $book->id)
                    ->whereNull('return_date')
                    ->sum('count');

                $book->available_count = $book->count_of_items - $issuedCount;
                return $book;
            })
            ->where('available_count', '>', 0);

        return view('accounting.issuance.index', compact('readers', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reader_id' => 'required|exists:readers,id',
            'book_ids' => 'required|array',
            'book_ids.*' => 'exists:books,id'
        ]);

        $reader = Reader::findOrFail($request->reader_id);


        if (!$reader->can_get_books) {
            return redirect()->back()->with('error', 'Этому читателю нельзя выдавать книги');
        }

        $bookCounts = array_count_values($request->book_ids);

        foreach ($bookCounts as $bookId => $count) {
            $book = Book::findOrFail($bookId);


            $issuedCount = BooksAction::where('book_id', $bookId)
                ->whereNull('return_date')
                ->sum('count');

            $available = $book->count_of_items - $issuedCount;

            if ($count > $available) {
                return redirect()->back()->with('error', "Книга '{$book->fullname}' недоступна в количестве {$count}. Доступно: {$available}");
            }


            BooksAction::create([
                'book_id' => $bookId,
                'reader_id' => $reader->id,
                'get_date' => now(),
                'return_date' => null,
                'count' => $count
            ]);
        }

        return redirect()->route('accounting.issuance.index')->with('success', 'Книги успешно выданы');
    }
}
