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
        Schema::create('seleksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik', 255);
            $table->string('nama_lengkap', 255)->nullable();
            $table->enum('status_tahap_1', ['menunggu', 'lolos', 'gagal'])->nullable();
            $table->string('judul_essay', 255)->nullable();
            $table->enum('status_tahap_2', ['terkunci', 'menunggu', 'lolos', 'gagal'])->default('terkunci');
            $table->boolean('sudah_wawancara')->default(false);
            $table->enum('status_final', ['menunggu', 'lulus', 'tidak_lulus'])->default('menunggu');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seleksi');
    }
};
