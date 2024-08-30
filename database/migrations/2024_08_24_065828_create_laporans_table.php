<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedInteger('id_sektor');
            $table->unsignedInteger('id_program');
            $table->unsignedInteger('id_proyek')->nullable();
            $table->string('judul_laporan');
            $table->integer('tanggal');
            $table->enum('bulan', ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']);
            $table->integer('tahun');
            $table->decimal('realisasi', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->json('images')->nullable();
            $table->enum('status', ['draf', 'pending', 'revisi', 'tolak', 'terbit'])->default('pending');
            $table->boolean('is_read')->default(0);
            $table->boolean('is_read_user')->default(0);
            $table->text('pesan_admin')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_sektor')->references('id')->on('sektors')->onDelete('cascade');
            $table->foreign('id_program')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('id_proyek')->references('id')->on('proyeks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};