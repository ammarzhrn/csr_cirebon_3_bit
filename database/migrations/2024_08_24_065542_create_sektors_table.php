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
        Schema::create('sektors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_sektor');
            $table->text('deskripsi');
            $table->string('thumbnail')->default('thumbnail.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sektors');
    }
};