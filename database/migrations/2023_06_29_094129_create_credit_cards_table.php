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
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('title', 64);
            $table->string('type', 20);
            $table->string('no', 20);
            $table->tinyInteger('month', false, true);
            $table->tinyInteger('year', false, true);
            $table->tinyInteger('cvc', false, true);
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_cards');
    }
};
