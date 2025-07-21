<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            // Hapus kolom string lama jika masih ada
            if (Schema::hasColumn('proposals', 'kabupaten_tujuan')) {
                $table->dropColumn('kabupaten_tujuan');
            }

            // Tambahkan foreign key hanya jika belum ada
            if (!Schema::hasColumn('proposals', 'kabupaten_tujuan_id')) {
                $table->unsignedBigInteger('kabupaten_tujuan_id')->nullable()->after('desa_id');
                $table->foreign('kabupaten_tujuan_id')->references('id')->on('kabupatens')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropForeign(['kabupaten_tujuan_id']);
            $table->dropColumn('kabupaten_tujuan_id');

            $table->string('kabupaten_tujuan')->nullable(); // Balikkan ke string jika rollback
        });
    }
};
