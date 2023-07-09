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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3);
            $table->string('name', 64);
            $table->string('name_tr', 64);
            $table->smallInteger('phone');
            $table->string('capital', 64);
            $table->string('currency', 12);
            $table->string('symbol', 12);
            $table->string('continent_code', 2);
        });
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
           '--class' => 'CountrySeeder',
           '--force' => true
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
