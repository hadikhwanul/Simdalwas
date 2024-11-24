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
            $table->string('pokok_rekomendasi', 1000);
            $table->string('sub_pokok_rekomendasi', 1000);
            $table->timestamps();
        });

        Schema::create('rekomendasis', function (Blueprint $table) {
            $table->id();
            $table->string('rekomendasi');
            $table->string('slug');
            $table->foreignId('temuan_id')->constrained('temuans')->onUpdate('cascade');
            $table->foreignId('pokok_rekomendasi_id')->constrained('pokok_rekomendasi')->onUpdate('cascade');
            $table->decimal('kerugian', 12, 2)->nullable();  // Presisi 12, skala 2 (contoh: 11111111111.11)
            $table->decimal('kewajiban', 12, 2)->nullable();  // Presisi 12, skala 2
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