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
        Schema::create('tb_parkirs', function (Blueprint $table) {
            $table->id();
            $table->integer('nim')->unsigned()->nullable();
            $table->foreign('nim')->references('nim')->on('tb_mahasiswas')->onDelete('cascade');
            $table->integer('nfc_num')->unsigned()->nullable();
            $table->foreign('nfc_num')->references('nfc_num')->on('tb_mahasiswas')->onDelete('cascade');
            $table->integer('nfc_num_ktp')->unsigned()->nullable();
            $table->foreign('nfc_num_ktp')->references('nfc_num_ktp')->on('tb_mahasiswas')->onDelete('cascade');
            $table->boolean('status_masuk');
            $table->boolean('status_keluar')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');;
            $table->bigInteger('updated_by')->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->string('hari');
            $table->string('tanggal');
            $table->string('jam');
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
        Schema::dropIfExists('tb_parkirs');
    }
};
