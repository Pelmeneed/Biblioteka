<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'fullname',
        'type_of_book_id',
        'author_id',
        'publishing_id',
        'year_of_publish',
        'count_of_sheets',
        'count_of_items'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publishing()
    {
        return $this->belongsTo(Publishing::class);
    }

    public function typeOfBook()
    {
        return $this->belongsTo(TypeOfBook::class, 'type_of_book_id');
    }
}
