<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function readers()
    {
        return $this->hasMany(Reader::class);
    }
}
