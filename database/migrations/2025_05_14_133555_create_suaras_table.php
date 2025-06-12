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
        Schema::create('suara', function (Blueprint $table) {
           $table->id();
    $table->foreignId('pengguna_id')->constrained('pengguna')->onDelete('cascade');
    $table->string('judul');
    $table->text('isi_saran');
    $table->enum('kategori', ['pendidikan', 'lingkungan', 'kesehatan', 'transportasi', 'lainnya'])->nullable();
    $table->timestamps();
});
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suara');
    }
};
