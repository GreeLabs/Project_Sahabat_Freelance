<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('kerjasama')) {
            Schema::create('kerjasama', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_user');
                $table->unsignedBigInteger('id_mitra');
                $table->unsignedBigInteger('id_pekerjaan');
                $table->enum('status', ['menunggu', 'terima', 'tolak'])->default('menunggu');
                $table->timestamps();

                $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('id_mitra')->references('id')->on('mitras')->onDelete('cascade');
                $table->foreign('id_pekerjaan')->references('id')->on('pekerjaans')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kerjasama');
    }
};
