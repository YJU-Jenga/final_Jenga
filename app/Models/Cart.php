<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'count',
        'total_price',
    ];

    public function user() {
        return $this->belongsTo('\App\Models\User');
    }
    
    public function product() {
        return $this->hasMany('\App\Models\Product');
    }
}