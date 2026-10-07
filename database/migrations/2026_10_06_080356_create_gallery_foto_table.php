<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_foto', function (Blueprint $table) {
            $table->id();

            $table->foreignId('gallery_id')
                ->constrained('gallery')
                ->cascadeOnDelete();

            $table->string('foto')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('urutan')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_foto');
    }
};
