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
        Schema::create('data_kendaraan_parkirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mahasiswa')->nullable();
            $table->foreignId('nim')->nullable();
            $table->char('nomer_kendaraan',13);
            $table->date('kendaraan_masuk');
            $table->date('kendaraan_keluar');
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
        Schema::dropIfExists('data_kendaraan_parkirs');
    }
};
