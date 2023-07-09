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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('title', 128);
            $table->string('firstname', 255);
            $table->string('lastname', 255);
            $table->string('phone', 255);
            $table->string('country', 255);
            $table->string('city', 255);
            $table->string('district', 255);
            $table->string('postcode', 16);
            $table->string('address1', 128);
            $table->string('address2', 128);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
