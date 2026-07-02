<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mitras', function (Blueprint $table) {
            if (!Schema::hasColumn('mitras', 'nohp')) {
                $table->string('nohp')->nullable()->after('email');
            }
            if (!Schema::hasColumn('mitras', 'profil_picture')) {
                $table->string('profil_picture')->nullable()->after('nohp');
            }
            if (!Schema::hasColumn('mitras', 'role')) {
                $table->enum('role', ['basic', 'premium'])->default('basic')->after('profil_picture');
            }
            if (!Schema::hasColumn('mitras', 'quota_posted_jobs')) {
                $table->integer('quota_posted_jobs')->default(5)->after('role');
            }
            if (!Schema::hasColumn('mitras', 'status')) {
                $table->enum('status', ['aktif', 'suspended'])->default('aktif')->after('quota_posted_jobs');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mitras', function (Blueprint $table) {
            $columns = ['nohp', 'profil_picture', 'role', 'quota_posted_jobs', 'status'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('mitras', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
