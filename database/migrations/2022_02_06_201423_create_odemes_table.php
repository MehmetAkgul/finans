<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odemes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('tip')->default(0);// 0 ise ödeme 1 ise tahsilat
            $table->unsignedBigInteger('musteriId');
            $table->unsignedBigInteger('faturaId')->default(0);
            $table->double('fiyat');
            $table->date('tarih');
            $table->unsignedBigInteger('bankaId');
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
        Schema::dropIfExists('odemes');
    }
}
