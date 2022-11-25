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
        'count',
        'postal_code',
        'address',
        'state',
    ];

    public function user() {
        return $this->belongsTo('\App\Models\User');
    }

    public function product() {
        return $this->hasMany('\App\Models\Product');
    }
}
