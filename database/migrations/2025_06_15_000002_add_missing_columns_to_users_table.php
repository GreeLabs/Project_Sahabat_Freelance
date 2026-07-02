<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nohp')) {
                $table->string('nohp')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'keahlian')) {
                $table->string('keahlian')->nullable()->after('nohp');
            }
            if (!Schema::hasColumn('users', 'profil_picture')) {
                $table->string('profil_picture')->nullable()->after('keahlian');
            }
            if (!Schema::hasColumn('users', 'CV')) {
                $table->string('CV')->nullable()->after('profil_picture');
            }
            if (!Schema::hasColumn('users', 'portofolio')) {
                $table->string('portofolio')->nullable()->after('CV');
            }
            if (!Schema::hasColumn('users', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('portofolio');
            }
            if (!Schema::hasColumn('users', 'rating')) {
                $table->decimal('rating', 3, 2)->default(0)->after('deskripsi');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['basic', 'premium'])->default('basic')->after('rating');
            }
            if (!Schema::hasColumn('users', 'quota_lamaran')) {
                $table->integer('quota_lamaran')->default(5)->after('role');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->enum('status', ['aktif', 'suspended'])->default('aktif')->after('quota_lamaran');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['nohp', 'keahlian', 'profil_picture', 'CV', 'portofolio', 'deskripsi', 'rating', 'role', 'quota_lamaran', 'status'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
