<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $fillable = [
        'lastname',
        'firstname',
        'patronymic',
        'type_of_reader',
        'group_id',
        'can_get_books',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function booksActions()
    {
        return $this->hasMany(BooksAction::class);
    }
}
