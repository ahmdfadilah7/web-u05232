<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilAlternatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_alternatifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_alternatif');
            $table->unsignedBigInteger('kode_kriteria');
            $table->double('nilai_alternatif');
            $table->foreign('kode_alternatif')->references('id')->on('kategoris')->onDelete('cascade');
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
        Schema::dropIfExists('hasil_alternatifs');
    }
}
