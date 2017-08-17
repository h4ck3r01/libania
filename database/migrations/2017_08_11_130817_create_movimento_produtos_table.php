<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimentoProdutosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimento_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movimento_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->integer('quantidade')->unsigned();
            $table->integer('fluxo')->unsigned();
            $table->timestamps();

            $table->foreign('movimento_id')->references('id')->on('movimentos')->onDelete('CASCADE');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimento_produtos');
    }
}
