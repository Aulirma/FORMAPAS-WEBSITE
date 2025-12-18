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
        Schema::create('membeli', function (Blueprint $table) {
            $table->decimal('NIK', 16, 0);
            $table->integer('ID_PRODUCT');
            $table->string('trx_id', 50)->nullable();
            $table->string('nama_penerima', 100)->nullable();
            $table->text('alamat_pengiriman')->nullable();
            $table->string('no_wa', 20)->nullable();
            $table->integer('qty')->default(1)->nullable();
            $table->decimal('total_harga', 15, 0)->default(0)->nullable();
            $table->enum('status', ['MENUNGGU', 'SIAP_KIRIM', 'SELESAI', 'DITOLAK']);
            $table->string('alasan_penolakan', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['NIK', 'ID_PRODUCT']);

            $table->foreign('NIK')->references('NIK')->on('formuser')->onDelete('cascade');
            $table->foreign('ID_PRODUCT')->references('ID_PRODUCT')->on('product')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membeli');
    }
};
