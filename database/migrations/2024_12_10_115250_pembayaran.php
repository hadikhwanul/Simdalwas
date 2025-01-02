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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();  // Menambahkan constraint unique

            // Relasi ke tabel kecamatan
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->foreign('kecamatan_id')
                ->references('id')->on('kecamatan')
                ->onUpdate('cascade')->onDelete('set null');

            // Relasi ke tabel satkers
            $table->unsignedBigInteger('satker_id')->nullable();
            $table->foreign('satker_id')
                ->references('id')->on('satkers')
                ->onUpdate('cascade')->onDelete('set null');

            // Kolom kerugian dan kewajiban
            $table->decimal('total_kerugian', 15, 2)->default(0)->nullable();
            $table->decimal('sisa_kerugian', 15, 2)->default(0)->nullable();
            $table->decimal('bayar_kerugian', 15, 2)->default(0)->nullable();
            $table->text('peran_rugi')->nullable();
            $table->text('ket_rugi')->nullable();

            $table->decimal('total_kewajiban', 15, 2)->default(0)->nullable();
            $table->decimal('sisa_kewajiban', 15, 2)->default(0)->nullable();
            $table->decimal('bayar_kewajiban', 15, 2)->default(0)->nullable();
            $table->text('peran_wajib')->nullable();
            $table->text('ket_wajib')->nullable();

            // Tanggal jatuh tempo
            $table->date('deadline')->nullable();

            $table->string('user_tindak');

            // Relasi ke tabel tindaks
            $table->unsignedBigInteger('tindak_id')->nullable();
            $table->foreign('tindak_id')
                ->references('id')->on('tindaks')
                ->onUpdate('cascade')->onDelete('set null');

            // Relasi ke tabel users - Change to uuid
            $table->uuid('user_id')->nullable(); // Ensure `user_id` is UUID
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('set null');

            // Timestamps
            $table->timestamps();
        });




        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            // Relasi ke tabel tagihans
            $table->unsignedBigInteger('tagihan_id')->nullable();
            $table->foreign('tagihan_id')
                ->references('id')->on('tagihans')
                ->onUpdate('cascade')->onDelete('set null');

            // Status pembayaran (pending, successful, failed)
            $table->string('status')->default('pending');

            // Jumlah pembayaran
            $table->decimal('bayar_rugi', 15, 2);
            $table->decimal('bayar_wajib', 15, 2);

            // Resi pembayaran atau bukti transaksi
            $table->string('resi');

            // Tanggal pembayaran
            $table->date('tanggal_bayar');

            // Timestamps
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};