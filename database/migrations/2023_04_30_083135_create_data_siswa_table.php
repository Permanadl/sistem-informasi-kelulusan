<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 10)->unique();
            $table->string('nisn', 10)->unique();
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran');
            $table->foreignId('jurusan_id')->constrained('jurusan');
            $table->string('nama_siswa', 50);
            $table->string('jenis_kelamin', 15);
            $table->string('foto', 50)->nullable();
            $table->boolean('status_kelulusan')->nullable();
            $table->string('surat_kelulusan', 100)->nullable();
            $table->boolean('status_lihat')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_siswa');
    }
}
