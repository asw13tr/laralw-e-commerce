<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * ürün adı
         * slug
         * açıklama
         * detay
         * fiyat
         * kdv
         * stok
         * resim

         * status
         *
         */
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug',255);
            $table->string('description',512)->nullable();
            $table->string('keywords',512)->nullable();
            $table->text('content')->nullable();
            $table->float('price')->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->float('tax')->default(0.0);
            $table->string('cover',128)->nullable();;
            $table->boolean('status')->default(true);
            $table->unsignedInteger('user_id');
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
