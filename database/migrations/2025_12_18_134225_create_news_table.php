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
        Schema::create('news', function (Blueprint $table) {
            $table->increments('NO_NEWS');
            $table->integer('ADMIN_ID')->nullable();
            $table->longBlob('FOTO_NEWS')->nullable();
            $table->text('JUDUL_NEWS')->nullable();
            $table->char('LOKASI_NEWS', 255)->nullable();
            $table->text('ISI_NEWS')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

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
        Schema::dropIfExists('news');
    }
};
