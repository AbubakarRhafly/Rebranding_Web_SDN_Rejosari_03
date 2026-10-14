<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('email', 150)->nullable();
            $table->string('no_hp', 30)->nullable();
            $table->string('judul', 255);
            $table->text('isi');
            $table->enum('status', [
                'baru',
                'diproses',
                'selesai'
            ])->default('baru');
            $table->text('tanggapan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
