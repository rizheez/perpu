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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('buku_id');
            $table->string('anggota_id');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian')->nullable();
            $table->integer('denda')->nullable();
            $table->string('petugas_id');
            $table->timestamps();

            $table->foreign('buku_id')->references('id')->on('buku')->constrained();
            $table->foreign('anggota_id')->references('id')->on('anggota')->constrained();
            $table->foreign('petugas_id')->references('id')->on('petugas')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
