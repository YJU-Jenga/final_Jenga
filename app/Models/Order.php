<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'postal_code',
        'address',
    ];

    public function user() {
        return $this->belongsTo('\App\Models\User');
    }

    public function product() {
        return $this->hasMany('\App\Models\Product');
    }

    public function cart() {
        return $this->belongsTo('\App\Models\Cart');
    }
}
