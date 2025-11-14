<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeOfBook extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
}
