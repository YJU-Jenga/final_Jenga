<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'cart_id',
        'postal_code',
        'address',
        'created_at',
        'updated_at',
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