<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisAlternatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_alternatifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_alternatif_1');
            $table->unsignedBigInteger('kode_alternatif_2');
            $table->unsignedBigInteger('kode_kriteria');
            $table->double('nilai');
            $table->double('bobot')->nullable();
            $table->double('jumlah')->nullable();
            $table->foreign('kode_alternatif_1')->references('id')->on('kategoris')->onDelete('cascade');
            $table->foreign('kode_alternatif_2')->references('id')->on('kategoris')->onDelete('cascade');
            $table->foreign('kode_kriteria')->references('id')->on('kriterias')->onDelete('cascade');
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
        Schema::dropIfExists('analisis_alternatifs');
    }
}
