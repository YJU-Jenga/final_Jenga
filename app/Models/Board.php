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

    public function post()
    {
        return $this->hasMany('\App\Models\Post');
    }
}

// 1 = 상품 문의 게시판
// 2 = Q & A 게시판
// 3 = 후기 게시판