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
        Schema::create('table_mhs', function (Blueprint $table) {
            $table->id()->unique();
            $table->string("Fullname");
            $table->string("NIM")->unique();
            $table->string("NISN")->unique();
            $table->string("Tempat_Lahir")->nullable();
            $table->date("Tanggal_Lahir");
            $table->text("Alamat");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_mhs');
    }
};
