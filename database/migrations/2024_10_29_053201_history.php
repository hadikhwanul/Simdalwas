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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lhp_id')->constrained('lhps')->onUpdate('cascade')->onDelete('cascade')->nullable(); // Foreign key to lhps
            $table->string('history');
            $table->string('revisi_dalnis')->nullable();
            $table->string('revisi_irban')->nullable();
            $table->string('revisi_sekretaris')->nullable();
            $table->string('revisi_inspektur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historys');
    }
};