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
        Schema::create('buku', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('judul', 100);
            $table->string('penulis');
            $table->string('kategori_id');
            $table->foreignId('penerbit_id')->constrained('penerbit');
            $table->char('tahun_terbit', 4);
            $table->integer('stok');
            $table->string('gambar')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
