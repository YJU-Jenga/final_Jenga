<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'type',
        'img',
    ];

    public function cart() {
        return $this->belongsTo('\App\Models\Cart');
    }

    public function order() {
        return $this->belongsTo('\App\Models\Order');
    }
}