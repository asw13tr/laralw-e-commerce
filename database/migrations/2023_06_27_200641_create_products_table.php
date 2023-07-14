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
            $table->string('sno', 64)->nullable();
            $table->string('barcode', 64)->nullable();
            $table->string('sku', 64);
            $table->string('title', 255);
            $table->string('description',512)->nullable();
            $table->string('keywords',512)->nullable();
            $table->text('content')->nullable();
            $table->decimal('price', 9,2)->default(0);
            $table->unsignedInteger('discount_id')->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->decimal('tax', 5,2)->default(0.0);
            $table->string('cover',128)->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('is_virtual')->default(false);
            $table->boolean('free_delivery')->default(false);
            $table->decimal('free_delivery_price', 5,2)->default(0);
            $table->decimal('delivery_price', 5,2)->default(0);
            $table->unsignedInteger('shop_id');
            $table->timestamps();
            $table->softDeletes()->nullable();
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
