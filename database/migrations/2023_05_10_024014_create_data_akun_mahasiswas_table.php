<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_akun_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mahasiswa');
            $table->foreignId('nim',7);
            $table->string('nama_mahasiswa');
            $table->char('angkatan',4);
            $table->string('foto')->nullable();
            $table->char('nomer_kendaraan',13);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_akun_mahasiswas');
    }
};
