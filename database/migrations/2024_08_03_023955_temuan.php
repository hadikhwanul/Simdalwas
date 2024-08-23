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
        Schema::create('temuans', function (Blueprint $table) {
            $table->id();
            $table->string('temuan');
            $table->foreignId('penyebab_id')->references('id')->on('penyebabs')->onUpdate('cascade');
            $table->foreignId('rekomendasi_id')->references('id')->on('rekomendasis')->onUpdate('cascade');
            $table->foreignId('tindak_id')->references('id')->on('tindaks')->onUpdate('cascade');
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temuans');
    }
};
