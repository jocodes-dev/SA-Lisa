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
        Schema::create('tb_surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('id_user');
            $table->string('no_surat');
            $table->foreignId('id_jenis_surat')->constrained('tb_jenis_surat');
            $table->string('tanggal_surat');
            $table->text('perihal');
            $table->string('asal_surat');
            $table->string('file_surat_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_surat_masuk');
    }
};
