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
        Schema::create('darurat', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel pengguna
            $table->foreignId('pengguna_id')->constrained('pengguna')->onDelete('cascade');

            // Info pelapor
            $table->string('nama_pelapor');

            // Kategori pengaduan
            $table->enum('kategori', ['darurat', 'sedang', 'standard']);

            // Deskripsi atau keterangan tambahan
            $table->text('keterangan')->nullable();

            // Lokasi dari Flutter (alamat atau koordinat string)
            $table->string('lokasi');

            // Foto dari Flutter (hanya nama file)
            $table->string('foto');

            // Status proses pengaduan
            $table->enum('status', ['dikirim', 'diproses', 'ditangani'])->default('dikirim');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('darurats');
    }
};
