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
        Schema::create('lhps', function (Blueprint $table) {
            $table->id();
            $table->integer('noLHP');
            $table->string('judul');
            $table->string('slug');
            $table->date('tanggal_lhp');
            $table->date('tahun');
            $table->foreignId('auditor_id')->references('id')->on('auditors')->onUpdate('cascade');
            $table->foreignId('bidang_id')->references('id')->on('bidangs')->onUpdate('cascade');
            $table->foreignId('induk_id')->references('id')->on('induks')->onUpdate('cascade');
            $table->foreignId('history_id')->references('id')->on('historys')->onUpdate('cascade');
            $table->foreignId('departemen_id')->references('id')->on('departemens')->onUpdate('cascade');
            $table->foreignId('temuan_id')->references('id')->on('temuans')->onUpdate('cascade');
            $table->string('status');
            $table->string('laporan');
            $table->string('create');
            $table->string('update');
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
