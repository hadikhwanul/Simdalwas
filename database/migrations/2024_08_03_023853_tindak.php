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
        Schema::create('tindaks', function (Blueprint $table) {
            $table->id();
            $table->string('tindaklanjut');
            $table->string('pokok_tl');
            $table->string('subpokok_tl');
            $table->string('ket_tl');
            $table->string('status');
            $table->date('tanggal_tl');
            $table->foreignId('penanggung_id')->references('id')->on('penanggungs')->onUpdate('cascade');
            $table->string('laporan_tl');
            $table->string('create_tl');
            $table->string('update_tl');
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
