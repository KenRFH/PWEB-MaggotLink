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
        Schema::create('penjadwalan', function (Blueprint $table) {
            $table->id();
            $table->integer('total_berat');
            $table->string('gambar');
            $table->foreignId('jadwal_admins_id')->constrained('jadwal_admins')->onDelete('cascade');
            $table->foreignId('detail_alamat_id')->constrained('detail_alamat')->onDelete('cascade');
            $table->boolean('status')->default(0); // 0 = unclaim, 1 = claimed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjadwalan');
    }
};
