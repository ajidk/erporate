<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePariwisata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_pariwisata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pariwisata_nama');
            $table->string('pariwisata_alamat');
            $table->text('pariwisata_detail');
            $table->string('pariwisata_gambar');
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
        Schema::dropIfExists('table_pariwisata');
    }
}
