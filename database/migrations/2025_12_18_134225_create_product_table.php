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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('ID_PRODUCT');
            $table->integer('ADMIN_ID')->nullable();
            $table->text('NAMA_PRODUCT')->nullable();
            $table->text('JENIS_PRODUCT')->nullable();
            $table->float('HARGA_PRODUCT', 6, 0)->nullable();
            $table->string('FOTO_PRODUCT', 256)->nullable();

            $table->foreign('ADMIN_ID')
                ->references('ADMIN_ID')
                ->on('formadmin')
                ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
