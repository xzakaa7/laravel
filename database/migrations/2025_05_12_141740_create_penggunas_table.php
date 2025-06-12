<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password'); // hash password
            $table->string('no_hp');
            $table->text('alamat');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
