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
        Schema::create('manage_sub_kategoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('manage_kategoris')->onDelete('cascade')->onUpdate('cascade');
            $table->string('first_nama_sub_kategori');
            $table->string('second_nama_sub_kategori')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_sub_kategoris');
    }
};
