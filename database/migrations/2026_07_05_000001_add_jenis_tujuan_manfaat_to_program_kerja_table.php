<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_kerja', function (Blueprint $table) {
            if (!Schema::hasColumn('program_kerja', 'jenis')) {
                $table->string('jenis')->default('Program Kerja')->after('kategori');
            }
            if (!Schema::hasColumn('program_kerja', 'tujuan')) {
                $table->text('tujuan')->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('program_kerja', 'manfaat')) {
                $table->text('manfaat')->nullable()->after('tujuan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('program_kerja', function (Blueprint $table) {
            if (Schema::hasColumn('program_kerja', 'jenis')) {
                $table->dropColumn('jenis');
            }
            if (Schema::hasColumn('program_kerja', 'tujuan')) {
                $table->dropColumn('tujuan');
            }
            if (Schema::hasColumn('program_kerja', 'manfaat')) {
                $table->dropColumn('manfaat');
            }
        });
    }
};
