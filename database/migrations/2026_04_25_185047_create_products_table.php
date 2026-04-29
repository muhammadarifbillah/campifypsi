<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('nama_produk')->nullable();
            $table->string('category')->nullable();
            $table->string('kategori')->nullable();
            $table->text('description')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('buy_price')->nullable();
            $table->integer('rent_price')->nullable();
            $table->integer('price')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('is_rental')->default(false);
            $table->enum('jenis_produk', ['jual', 'sewa'])->default('jual');
            $table->float('rating')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->string('image')->nullable();
            $table->string('gambar')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('stok')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
