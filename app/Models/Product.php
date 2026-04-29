<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;
use App\Models\Courier;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'user_id',
        'name',
        'nama_produk',
        'category',
        'kategori',
        'description',
        'deskripsi',
        'buy_price',
        'rent_price',
        'price',
        'status',
        'is_rental',
        'jenis_produk',
        'rating',
        'reviews_count',
        'image',
        'gambar',
        'stock',
        'stok',
    ];

    protected $casts = [
        'buy_price' => 'integer',
        'rent_price' => 'integer',
        'price' => 'integer',
        'rating' => 'float',
        'reviews_count' => 'integer',
        'stock' => 'integer',
        'stok' => 'integer',
        'is_rental' => 'boolean',
    ];

    // 🔥 RELASI KE TOKO
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function couriers()
    {
        return $this->belongsToMany(Courier::class, 'product_courier')->withTimestamps();
    }
}