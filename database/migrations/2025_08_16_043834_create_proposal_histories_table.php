<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('proposal_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id');
            $table->unsignedBigInteger('user_id'); // siapa yang melakukan
            $table->string('action'); // accepted / rejected / revised
            $table->text('note')->nullable(); // kalau mau kasih alasan / catatan
            $table->timestamps();

            $table->foreign('proposal_id')->references('id')->on('proposals')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('proposal_histories');
    }

};
