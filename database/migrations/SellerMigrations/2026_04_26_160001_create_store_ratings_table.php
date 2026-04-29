<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('store_ratings')) {
            return;
        }
    }

    public function down()
    {
        Schema::dropIfExists('store_ratings');
    }
};