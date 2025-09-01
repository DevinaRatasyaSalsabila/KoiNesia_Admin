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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk');
            $table->integer('harga_satuan');
            $table->integer('stok');
            $table->string('ukuran');
            $table->text('deskripsi');
            $table->text('gambar');
            $table->string('kode_produk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
