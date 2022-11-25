<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
<<<<<<< HEAD
        'phone',
=======
>>>>>>> ced5d6b (clean push)
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
<<<<<<< HEAD

    public function post () {
        return $this->hasMany('\App\Models\Post');
    }

    public function comment () {
        return $this->hasMany('\App\Models\Comment');
    }

    public function order () {
        return $this->hasMany('\App\Models\Order');
    }

    public function cart () {
        return $this->hasOne('\App\Models\Cart');
    }
=======
>>>>>>> ced5d6b (clean push)
}
