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
            $table->string('sub_pokok_tindak');
            $table->timestamps();
        });

        Schema::create('tindaks', function (Blueprint $table) {
            $table->id();
            $table->string('tindak');
            $table->string('slug');
            $table->foreignId('pokok_tindak_id')->constrained('pokok_tindak')->onUpdate('cascade');
            $table->string('status');
            $table->date('tanggal_tl');
            $table->foreignId('rekomendasi_id')->nullable()->constrained('rekomendasis')->onUpdate('cascade');
            $table->string('laporan_tl')->nullable();
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