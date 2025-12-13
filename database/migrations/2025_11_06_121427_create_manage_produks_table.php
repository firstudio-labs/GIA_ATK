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
        Schema::create('manage_produks', function (Blueprint $table) {
            $table->id(); // Id
            $table->string('slug')->unique(); // Slug
            $table->string('judul'); // Judul
            $table->foreignId('kategori_id')->constrained('manage_kategoris')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sub_kategori_id')->constrained('manage_sub_kategoris')->onDelete('cascade')->onUpdate('cascade');

            // Gambar Produk (lebih dari 1). Untuk menampung banyak gambar, bisa dalam bentuk JSON atau table relasi.
            // Di sini menggunakan JSON field untuk menyimpan array nama file/gambar.
            $table->json('gambar_produk')->nullable();

            $table->decimal('harga', 15, 2); // Harga
            $table->unsignedTinyInteger('diskon')->nullable(); // Diskon (Opsional) dalam persen %
            $table->string('sku'); // SKU
            $table->text('deskripsi'); // Deskripsi

            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif'); // Status

            // Informasi Tambahan
            $table->decimal('berat', 8, 2)->nullable(); // Berat (kg)
            $table->string('ukuran')->nullable(); // Ukuran
            $table->string('warna')->nullable(); // Warna

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_produks');
    }
};
