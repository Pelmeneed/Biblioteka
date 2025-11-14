<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooksAction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'book_id',
        'reader_id',
        'get_date',
        'return_date',
        'count'
    ];


    protected $dates = ['get_date', 'return_date'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }
}
