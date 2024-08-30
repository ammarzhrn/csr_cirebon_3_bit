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
        Schema::create('summary', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_user');
            $table->string('foto_pp')->default('profile.png');
            $table->string('nama_mitra')->nullable();
            $table->string('nama');
            $table->string('no_telp')->nullable();
            $table->string('email');
            $table->string('alamat')->nullable();
            $table->text('deskripsi')->nullable();
            // $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
            $table->foreign('id_user')->on('users')->references('id')->onUpdate('cascade');
            $table->boolean('is_read')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summary');
    }
};
