<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_proposal_id')->nullable()->after('user_id');
            $table->foreign('jenis_proposal_id')->references('id')->on('jenis_proposals')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropForeign(['jenis_proposal_id']);
            $table->dropColumn('jenis_proposal_id');
        });
    }
};
