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
        Schema::create('manage_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Section
            $table->json('product_ids')->nullable(); // List id produk dalam bentuk JSON
            $table->unsignedTinyInteger('discount_percentage')->nullable(); // Diskon (%) opsional
            $table->boolean('is_new')->default(false); // Tampilkan badge "new"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_sections');
    }
};
