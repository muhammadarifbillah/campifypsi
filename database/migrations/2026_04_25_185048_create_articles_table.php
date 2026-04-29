<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->text('content');
            $table->longText('body')->nullable();
            $table->string('author')->nullable();
            $table->date('date')->nullable();
            $table->string('category')->nullable();
            $table->string('image')->nullable();

            $table->timestamp('waktu_posting')->nullable();
            $table->string('kategori_slug')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->string('thumbnail')->nullable();
            $table->integer('views')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};