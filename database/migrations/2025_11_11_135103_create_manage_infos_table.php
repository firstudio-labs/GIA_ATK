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
        Schema::create('manage_infos', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul
            $table->text('deskripsi')->nullable(); // Deskripsi
            $table->string('gambar')->nullable(); // Foto/Gambar (path atau filename)
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif'); // Status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_infos');
    }
};
