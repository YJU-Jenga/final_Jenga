<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'password',
        'content',
        'hit',
        'state',
        'secret',
        'img',
    ];

    public function board() {
        return $this->belongsTo('\App\Models\Board');
    }

    public function user() {
        return $this->belongsTo('\App\Models\User');
    }

    public function commnet() {
        return $this->hasMany('\App\Models\Comment');
    }
    
}
