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

        Schema::create('jobdesks', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();  // UUID sebagai primary key
            $table->string('profile')->nullable();
            $table->string('nama');
            $table->string('username');
            $table->string('NIP')->unique();  // Ubah NIP ke string, jika diperlukan unik bisa ditambahkan
            $table->string('no_hp')->unique();  // Ubah no_hp ke string
            $table->string('no_wa')->unique();  // Ubah no_wa ke string
            $table->string('kelompok');
            $table->foreignId('jobdesk_id')->constrained('jobdesks')->onUpdate('cascade');  // Sederhanakan relasi foreign key
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};