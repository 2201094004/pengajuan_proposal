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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->string('nama'); 
            $table->string('title'); 
            $table->text('description'); 
            $table->string('email'); 
            $table->string('no_hp')->nullable();
            $table->string('no_rekening')->nullable(); 
            $table->text('alamat'); 

            // Lokasi asal
            $table->unsignedBigInteger('kabupaten_id');
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->unsignedBigInteger('desa_id')->nullable();

            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('restrict');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('restrict');
            $table->foreign('desa_id')->references('id')->on('desas')->onDelete('restrict');

            // Tujuan proposal
            $table->unsignedBigInteger('kabupaten_tujuan_id');
            $table->foreign('kabupaten_tujuan_id')->references('id')->on('kabupatens');

            // Dokumen proposal & form penilaian auto
            $table->string('proposal_file')->nullable(); // ganti dari 'document'
            $table->string('form_penilaian_auto')->nullable();

            // Status proposal
            $table->enum('status', ['draft', 'submitted', 'accepted', 'rejected', 'revised'])->default('draft');

            $table->timestamps();

            // Relasi ke users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

           // migration add_verified_by_to_proposals
            // $table->unsignedBigInteger('verified_by')->nullable();
            // $table->foreign('verified_by')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
