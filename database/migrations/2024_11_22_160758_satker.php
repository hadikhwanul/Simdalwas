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
        Schema::create('satkers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('no_opd'); // Nomor OPD
            $table->integer('no_sekolah')->default('0'); // Nomor sekolah, default ke '0'
            $table->string('opd'); // Nama OPD
            $table->string('sekolah'); // Nama sekolah
            $table->timestamps(); // Created at dan Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satkers');
    }
};