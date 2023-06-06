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
        Schema::create('jadwal_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dosen')->nullable();
            $table->integer('id_mahasiswa')->nullable();
            $table->string('mata_kuliah')->nullable();
            $table->string('ruangan')->nullable();
            $table->string('hari')->nullable();
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
        Schema::dropIfExists('jadwal_details');
    }
};
