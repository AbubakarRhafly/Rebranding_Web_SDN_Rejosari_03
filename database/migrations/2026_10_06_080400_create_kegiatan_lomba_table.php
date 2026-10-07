<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan_lomba', function (Blueprint $table) {
            $table->id();

            $table->enum('kategori', [
                'MAPSI',
                'Literasi',
                'Bahasa Jawa',
                'Siswa Berprestasi',
                'Motivasi & Inspiratif'
            ]);

            $table->string('judul', 255);
            $table->string('nama_peserta', 150)->nullable();
            $table->string('kelas', 20)->nullable();
            $table->string('jenis_kegiatan', 150)->nullable();
            $table->string('tingkat', 100)->nullable();
            $table->string('hasil', 150)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_lomba');
    }
};
