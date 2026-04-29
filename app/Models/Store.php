<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama_toko',
        'deskripsi',
        'alamat',
        'logo',
        'catatan_admin',
        'status',
        'last_active',
        'alasan_ban'
    ];

    protected $casts = [
        'last_active' => 'datetime',
    ];

    // 🔥 RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔥 RELASI KE PRODUK
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // 🔥 RELASI KE TRANSAKSI MELALUI PRODUK
    public function transactions()
    {
        return $this->hasManyThrough(\App\Models\Transaction::class, \App\Models\Product::class);
    }
}