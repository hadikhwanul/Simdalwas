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
        Schema::create('pokok_rekomendasi', function (Blueprint $table) {
            $table->id();
            $table->integer('no_pokok');
            $table->integer('no_subpokok');
            $table->string('pokok_rekomendasi', 1000); // Change 1000 to the desired length
            $table->timestamps();
        });

        Schema::create('rekomendasis', function (Blueprint $table) {
            $table->id();
            $table->string('rekomendasi');
            $table->foreignId('pokok_rekomendasi_id')->references('id')->on('pokok_rekomendasi')->onUpdate('cascade');
            $table->integer('kerugian')->nullable();
            $table->integer('kewajiban')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasis');
    }
};