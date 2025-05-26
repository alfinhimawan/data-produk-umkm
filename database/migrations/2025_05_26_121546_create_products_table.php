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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id_product');
            $table->unsignedBigInteger('id_umkm');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_produk', 150);
            $table->decimal('harga', 15, 2);
            $table->text('deskripsi');
            $table->string('foto', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_umkm')->references('id_umkm')->on('umkm_profiles')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
