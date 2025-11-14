<?php

namespace App\Http\Controllers;

use App\Models\BooksAction;
use App\Models\Book;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {

        $issuedBooks = BooksAction::with(['book.author', 'book.publishing', 'reader.group'])
            ->whereNull('return_date')
            ->orderBy('get_date', 'desc')
            ->get();

        return view('accounting.return.index', compact('issuedBooks'));
    }

    public function returnBook($bookActionId)
    {
        $bookAction = BooksAction::findOrFail($bookActionId);
        $bookAction->update(['return_date' => now()]);

        return redirect()->route('accounting.return.index')
            ->with('success', 'Книга "' . $bookAction->book->fullname . '" успешно возвращена');
    }

    public function returnMultiple(Request $request)
    {
        $request->validate([
            'book_actions' => 'required|array',
            'book_actions.*' => 'exists:books_actions,id'
        ]);

        $count = BooksAction::whereIn('id', $request->book_actions)
            ->whereNull('return_date')
            ->update(['return_date' => now()]);

        return redirect()->route('accounting.return.index')
            ->with('success', "Успешно возвращено $count книг(и)");
    }

    public function returnById(Request $request)
    {
        $request->validate([
            'book_id' => 'required'
        ]);

        $bookAction = BooksAction::where('id', $request->book_id)
            ->orWhereHas('book', function($query) use ($request) {
                $query->where('id', $request->book_id);
            })
            ->whereNull('return_date')
            ->first();

        if (!$bookAction) {
            return redirect()->route('accounting.return.index')
                ->with('error', 'Книга с указанным ID не найдена или уже возвращена');
        }

        $bookAction->update(['return_date' => now()]);

        return redirect()->route('accounting.return.index')
            ->with('success', 'Книга "' . $bookAction->book->fullname . '" успешно возвращена');
    }
}
