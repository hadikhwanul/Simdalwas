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
        Schema::create('pokok_penyebab', function (Blueprint $table) {
            $table->id();
            $table->integer('no_pokok');
            $table->integer('no_subpokok');
            $table->string('pokok_penyebab');
            $table->timestamps();
        });
        
        Schema::create('penyebabs', function (Blueprint $table) {
            $table->id();
            $table->string('penyebab');
            $table->foreignId('id_pokok_penyebab')->references('id')->on('pokok_penyebab')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyebabs');
    }
};