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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->string('alamat')->nullable();
            $table->string('no_telp', 20);
            $table->string('nama_instansi');
            $table->string('mitra_csr')->nullable();
            $table->string('nama_program')->nullable();
            $table->boolean('is_read')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
