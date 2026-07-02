<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekerjaansTable extends Migration
{
    public function up()
    {
        Schema::create('pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mitra'); // Relasi dengan tabel mitra
            $table->string('nama_lowongan');
            $table->string('jenis_lowongan');
            $table->decimal('gaji_minimal', 10, 2);
            $table->decimal('gaji_maksimal', 10, 2);
            $table->text('deskripsi');
            $table->text('lokasi');
            $table->string('foto')->nullable(); // Untuk menyimpan nama file foto
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pekerjaans');
    }
}

