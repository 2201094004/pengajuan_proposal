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
        Schema::create('evaluation_result_files', function (Blueprint $table) {
            $table->id();

            // Relasi ke proposal & user
            $table->unsignedBigInteger('proposal_id');
            $table->unsignedBigInteger('user_id'); // stakeholder

            // File dan catatan
            $table->string('file_path');
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
        Schema::dropIfExists('evaluation_result_files');
    }
};
