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
        Schema::create('pokok_tindak', function (Blueprint $table) {
            $table->id();
            $table->integer('no_pokok');
            $table->integer('no_subpokok');
            $table->string('pokok_tindak');
            $table->timestamps();
        });

        Schema::create('tindaks', function (Blueprint $table) {
            $table->id();
            $table->string('tindak');
            $table->foreignId('pokok_tindak_id')->references('id')->on('pokok_tindak')->onUpdate('cascade');
            $table->string('ket_tl');
            $table->string('status');
            $table->date('tanggal_tl');
            $table->foreignId('penanggung_id')->references('id')->on('penanggungs')->onUpdate('cascade');
            $table->string('laporan_tl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindaks');
    }
};