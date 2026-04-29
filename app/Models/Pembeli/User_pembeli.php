<?php

namespace App\Models\Pembeli;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Pembeli\Chat_pembeli;

class User_pembeli extends Authenticatable
{
    protected $table = 'users';

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'city',
        'district',
        'postal_code',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function productRatings()
    {
        return $this->hasMany(ProductRating_pembeli::class, 'user_id');
    }

    public function rentals()
    {
        return $this->hasMany(Rental_pembeli::class, 'user_id');
    }

    public function chats()
    {
        return $this->hasMany(Chat_pembeli::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order_pembeli::class, 'user_id');
    }
}
