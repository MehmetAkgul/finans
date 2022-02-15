<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIslemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('islems', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(0);// 0 ise ödeme 1 ise tahsilat
            $table->unsignedBigInteger('musteriId');
            $table->unsignedBigInteger('faturaId')->default(0);
            $table->double('fiyat');
            $table->date('tarih');
            $table->unsignedBigInteger('hesap');
            $table->unsignedBigInteger('odemeSekli');
            $table->text('description');
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
        Schema::dropIfExists('islems');
    }
}
