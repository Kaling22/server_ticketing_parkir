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
            $table->string('nfc_num')->unique();
            $table->string('name');
            $table->string('jurusan');
            $table->string('fakultas');
            $table->string('angkatan');
            $table->string('foto');
            $table->string('telepon');
            $table->bigInteger('id_kendaraan')->unsigned();;
            $table->foreign('id_kendaraan')->references('id')->on('tb_kendaraans')->onDelete('cascade');
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
