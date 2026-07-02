<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah FK notifications_id_mitra_foreign ada
        $fkExists = false;
        try {
            $fks = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.TABLE_CONSTRAINTS 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'notifications' 
                AND CONSTRAINT_TYPE = 'FOREIGN KEY'
                AND CONSTRAINT_NAME LIKE '%id_mitra%'
            ");
            $fkExists = count($fks) > 0;
        } catch (\Exception $e) {
            // Biarkan, FK mungkin tidak ada
        }

        if ($fkExists) {
            Schema::table('notifications', function (Blueprint $table) use ($fks) {
                foreach ($fks as $fk) {
                    $table->dropForeign($fk->CONSTRAINT_NAME);
                }
            });
        }

        // Tambah FK baru ke mitras (jika belum ada)
        try {
            Schema::table('notifications', function (Blueprint $table) {
                $table->foreign('id_mitra')->references('id')->on('mitras')->onDelete('cascade');
            });
        } catch (\Exception $e) {
            // FK mungkin sudah ada dengan referensi yang benar, abaikan
        }
    }

    public function down(): void
    {
        try {
            Schema::table('notifications', function (Blueprint $table) {
                $table->dropForeign(['id_mitra']);
            });
        } catch (\Exception $e) {
            // ignore
        }
    }
};
