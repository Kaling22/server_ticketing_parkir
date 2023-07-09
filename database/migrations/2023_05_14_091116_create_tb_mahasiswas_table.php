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
        Schema::create('tb_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->integer('nim')->unique()->unsigned();
            $table->integer('nfc_num')->unique()->unsigned()->nullable();
            $table->integer('nfc_num_ktp')->unique()->unsigned()->nullable();
            $table->string('name');
            $table->string('jurusan');
            $table->string('fakultas');
            $table->string('angkatan');
            $table->string('foto');
            $table->string('telepon');
            $table->smallInteger('status_mahasiswa');
            $table->text('kendaraan');
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
        Schema::dropIfExists('tb_mahasiswas');
    }
};
