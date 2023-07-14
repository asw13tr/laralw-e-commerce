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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('name', 255);
            $table->string('description', 512)->nullable();
            $table->string('owner', 255);
            $table->string('tax_office', 255);
            $table->string('tax_number', 255);
            $table->string('email', 255);
            $table->string('phone', 255);
            $table->unsignedTinyInteger('country_id');
            $table->string('city', 128);
            $table->string('district', 128);
            $table->unsignedMediumInteger('postcode');
            $table->string('address', 256);
            $table->unsignedSmallInteger('category_id');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
