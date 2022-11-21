<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'board_name',
    ];

    public function post () {
        return $this->hasMany('\App\Models\Post');
    }
}