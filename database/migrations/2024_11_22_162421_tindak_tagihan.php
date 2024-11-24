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
            $table->foreignId('pokok_tindak_id')->constrained('pokok_tindak')->onUpdate('cascade');
            $table->string('ket_tl');
            $table->string('status');
            $table->date('tanggal_tl');
            $table->foreignId('rekomendasi_id')->nullable()->constrained('rekomendasis')->onUpdate('cascade');
            $table->string('laporan_tl');
            $table->timestamps();
        });

        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->foreign('kecamatan_id')
                ->references('id')->on('kecamatan') // Sesuaikan dengan nama tabel yang benar
                ->onUpdate('cascade')->onDelete('set null');

            $table->unsignedBigInteger('satker_id')->nullable();
            $table->foreign('satker_id')
                ->references('id')->on('satkers')
                ->onUpdate('cascade')->onDelete('set null');

            $table->decimal('kerugian', 15, 2);
            $table->decimal('kewajiban', 15, 2);

            $table->unsignedBigInteger('tindak_id')->nullable();
            $table->foreign('tindak_id')
                ->references('id')->on('tindaks')
                ->onUpdate('cascade')->onDelete('set null');

            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('set null');

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