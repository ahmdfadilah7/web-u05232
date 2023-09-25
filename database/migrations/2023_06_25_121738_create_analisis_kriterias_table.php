<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_kriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_kriteria_1');
            $table->unsignedBigInteger('kode_kriteria_2');
            $table->double('nilai');
            $table->double('bobot')->nullable();
            $table->double('jumlah')->nullable();
            $table->foreign('kode_kriteria_1')->references('id')->on('kriterias')->onDelete('cascade');
            $table->foreign('kode_kriteria_2')->references('id')->on('kriterias')->onDelete('cascade');
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
        Schema::dropIfExists('analisis_kriterias');
    }
}
