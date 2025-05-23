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
        Schema::create('pickup_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_supplier")->constrained("supplier");
            $table->date("date");
            $table->enum('application_status',['pending','approved','rejected']);
            $table->date("notes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_schedule');
    }
};
