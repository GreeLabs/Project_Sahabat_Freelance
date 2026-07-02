<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lamarans', function (Blueprint $table) {
            if (!Schema::hasColumn('lamarans', 'id_mitra')) {
                $table->unsignedBigInteger('id_mitra')->nullable()->after('id_user');
            }
            if (!Schema::hasColumn('lamarans', 'deskripsiU')) {
                $table->text('deskripsiU')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('lamarans', function (Blueprint $table) {
            if (Schema::hasColumn('lamarans', 'id_mitra')) {
                $table->dropColumn('id_mitra');
            }
            if (Schema::hasColumn('lamarans', 'deskripsiU')) {
                $table->dropColumn('deskripsiU');
            }
        });
    }
};
