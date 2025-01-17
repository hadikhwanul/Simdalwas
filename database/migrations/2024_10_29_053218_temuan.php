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
        Schema::create('pokok_temuan', function (Blueprint $table) {
            $table->id();
            $table->integer('no_pokok');
            $table->integer('no_subpokok');
            $table->string('pokok_temuan');
            $table->string('sub_pokok_temuan');
            $table->timestamps();
        });

        Schema::create('temuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lhp_id')->constrained('lhps')->onUpdate('cascade')->onDelete('cascade'); // Foreign key to lhps
            $table->string('temuan');
            $table->string('keterangan');
            $table->foreignId('pokok_temuan_id')->constrained('pokok_temuan')->onUpdate('cascade');
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temuan');
    }
};