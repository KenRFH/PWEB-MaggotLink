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
    Schema::create('supplier', function (Blueprint $table) {
        $table->id();
        $table->string("email")->unique();
        $table->string("password");
        $table->string("nama")->nullable(); // ✅ cukup ->nullable()
        $table->string("nama_perusahaan")->nullable(); // ✅ cukup ->nullable()
        $table->string("no_telp")->nullable(); // ❗️lihat catatan bawah
        $table->string("gambar")->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier');
    }
};
