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
        Schema::table('manage_produks', function (Blueprint $table) {
            // Model (Bisa lebih dari 1) - menggunakan JSON untuk menyimpan array
            $table->json('model')->nullable()->after('sub_kategori_id');
            
            // Tags - menggunakan JSON untuk menyimpan array tags
            $table->json('tags')->nullable()->after('model');
            
            // Detail Produk - text untuk detail produk
            $table->text('detail_produk')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manage_produks', function (Blueprint $table) {
            $table->dropColumn(['model', 'tags', 'detail_produk']);
        });
    }
};

