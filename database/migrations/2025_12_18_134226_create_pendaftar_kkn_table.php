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
       Schema::create('pendaftar_kkn', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('nik', 16, 0);
            $table->string('nama_lengkap', 255);
            $table->string('universitas', 255);
            $table->year('tahun_masuk');
            $table->string('ttl', 255);
            $table->string('foto', 255)->nullable();
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->nullable();
            $table->timestamp('tanggal_ajuan')->useCurrent();
            $table->timestamp('tanggal_konfirmasi')->useCurrent();

            $table->foreign('nik')
                ->references('NIK')
                ->on('formuser')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar_kkn');
    }
};
