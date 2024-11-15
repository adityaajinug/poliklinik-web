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
        Schema::create('periksas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_dokter');
            $table->datetime('tgl_periksa')->nullable();
            $table->text('catatan')->nullable();
            $table->string('obat')->nullable();

            $table->foreign('id_pasien')->references('id')->on('pasiens')->onDelete('restrict');
            $table->foreign('id_dokter')->references('id')->on('dokters')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periksas');
    }
};
