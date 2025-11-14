<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'lastname',
        'firstname',
        'patronymic',
    ];

    public $timestamps = false;
}
