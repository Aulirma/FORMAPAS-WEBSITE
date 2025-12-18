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
        Schema::create('formuser', function (Blueprint $table) {
            $table->decimal('NIK', 16, 0)->primary();
            $table->text('USER_NAME')->nullable();
            $table->char('USER_EMAIL', 255)->nullable();
            $table->char('USER_PASSWORD', 255)->nullable();
            $table->integer('ADMIN_ID');
            $table->text('MBTI_RESULT')->nullable();

            $table->foreign('ADMIN_ID')
                ->references('ADMIN_ID')
                ->on('formadmin')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formuser');
    }
};
