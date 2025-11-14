<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\IssuanceController;
use App\Http\Controllers\PublishingController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\TypeOfBookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/login', function() {
    return view('auth.login');
})->name('login');


Route::post('/login', function(Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});


Route::post('/register', function(Illuminate\Http\Request $request) {
    $user = new App\Models\User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    Auth::login($user);
    return redirect('/');
})->name('register');


Route::post('/logout', function() {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::prefix('items')->group(function () {
    Route::resource('authors', AuthorController::class)->names('items.authors');
    Route::resource('books', BookController::class)->names('items.books');
    Route::resource('publishings', PublishingController::class)->names('items.publishings');
    Route::resource('types-of-books', TypeOfBookController::class)->names('items.types-of-books');
});


    Route::prefix('readers')->group(function () {
    Route::resource('groups', GroupController::class)->names('readers.groups');
    Route::resource('readers', ReaderController::class)->names('readers.readers');
});


    Route::prefix('accounting')->group(function () {
    Route::resource('issuance', IssuanceController::class)->names('accounting.issuance');
    Route::resource('return', ReturnController::class)->names('accounting.return');


    Route::post('return/by-id', [ReturnController::class, 'returnById'])->name('accounting.return.return-by-id');
    Route::post('return/multiple', [ReturnController::class, 'returnMultiple'])->name('accounting.return.multiple');
    Route::post('return/{bookAction}/return-single', [ReturnController::class, 'returnBook'])->name('accounting.return.return-by-id');
    });
});



