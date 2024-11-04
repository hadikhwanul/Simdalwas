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
        Schema::create('lhps', function (Blueprint $table) {
            $table->id();
            $table->string('no_lhp');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->date('tanggal_lhp');
            $table->foreignId('auditor_id')->constrained('auditors')->onUpdate('cascade');
            $table->foreignId('induk_id')->constrained('induks')->onUpdate('cascade');
            $table->foreignId('departemen_id')->nullable()->constrained('departemens')->onUpdate('cascade');
            $table->string('bidang')->nullable();
            $table->string('pemeriksa');
            $table->string('irban');
            $table->string('user');
            $table->string('sifat');
            $table->string('status');
            $table->string('laporan');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lhps');
    }
};