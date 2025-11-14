<?php

namespace App\Http\Controllers;

use App\Models\BooksAction;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $threeMonthsAgo = now()->subMonths(3);

        $monthlyStats = BooksAction::select(
            DB::raw('strftime("%m", get_date) as month'),
            DB::raw('strftime("%Y", get_date) as year'),
            DB::raw('COUNT(*) as issued_count'),
            DB::raw('SUM(CASE WHEN return_date IS NULL THEN 1 ELSE 0 END) as not_returned_count')
            )
            ->where('get_date', '>=', $threeMonthsAgo)
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $totalBooks = Book::sum('count_of_items');
        $issuedBooks = BooksAction::whereNull('return_date')->count();
        $availableBooks = $totalBooks - $issuedBooks;

        return view('home', compact('monthlyStats', 'totalBooks', 'issuedBooks', 'availableBooks'));
    }
}
