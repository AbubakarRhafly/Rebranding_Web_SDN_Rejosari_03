<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gallery', function (Blueprint $table) {
            $table->string('thumbnail_asli')->nullable()->after('thumbnail');
        });

        Schema::table('gallery_foto', function (Blueprint $table) {
            $table->string('foto_asli')->nullable()->after('foto');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_foto', function (Blueprint $table) {
            $table->dropColumn('foto_asli');
        });

        Schema::table('gallery', function (Blueprint $table) {
            $table->dropColumn('thumbnail_asli');
        });
    }
};
