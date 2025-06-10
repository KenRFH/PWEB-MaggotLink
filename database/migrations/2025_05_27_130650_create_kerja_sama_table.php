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
        Schema::create('kerja_sama', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('supplier')->onDelete('cascade');
            $table->foreignId('alamat_id')->constrained('alamat')->onDelete('cascade'); // relasi ke alamat
            $table->string('nama');
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->onDelete('cascade');
            $table->string('no_telepon', 30);
            $table->string('file_mou');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerja_sama');
    }
};
