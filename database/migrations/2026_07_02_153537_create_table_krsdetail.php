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
        Schema::create('krs_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_krs');
            $table->foreign('kode_krs')->references('id')->on('krs')->onDelete('cascade');

            $table->unsignedBigInteger('kode_kelas');
            $table->foreign('kode_kelas')->references('id')->on('kelas')->onDelete('cascade');

            $table->enum('status', ['pending', 'approved', 'declined']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krsdetails');
    }
};