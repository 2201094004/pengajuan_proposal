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
        Schema::create('proposal_evaluations', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('proposal_id');
            $table->unsignedBigInteger('user_id'); // stakeholder

            // Penilaian
            $table->integer('nilai_status');
            $table->integer('nilai_pengaruh');
            $table->integer('nilai_popularitas');
            $table->integer('nilai_hubungan_perusahaan');
            $table->integer('nilai_pelaksana');
            $table->integer('nilai_tujuan');
            $table->integer('nilai_lokasi');
            $table->integer('nilai_waktu');
            $table->integer('nilai_estimasi_dana');
            $table->integer('nilai_dampak');
            $table->integer('nilai_partisipasi');
            $table->integer('nilai_pengaruh_perusahaan');
            $table->integer('nilai_pencitraan');
            $table->integer('nilai_referensi');
            $table->string('pemberi_rekomendasi');

            // Hasil evaluasi
            $table->float('total_score');
            $table->enum('kesimpulan', ['dibantu', 'tidak dibantu']);
            $table->text('catatan')->nullable();

            $table->timestamps();

            // Relasi
            $table->foreign('proposal_id')->references('id')->on('proposals')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_evaluations');
    }
};
