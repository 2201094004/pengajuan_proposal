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
        Schema::create('status_histories', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('proposal_id');
            $table->unsignedBigInteger('user_id'); // yang mengubah status

            // Status dan catatan
            $table->enum('status', ['draft', 'submitted', 'accepted', 'rejected', 'revised']);
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
        Schema::dropIfExists('status_histories');
    }
};
