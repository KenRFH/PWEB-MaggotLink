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
       Schema::table('kerja_sama', function (Blueprint $table) {
    $table->dropForeign(['alamat_id']); // hapus foreign key dulu
    $table->dropColumn('alamat_id');    // lalu hapus kolomnya
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerja_sama', function (Blueprint $table) {
            //
        });
    }
};
