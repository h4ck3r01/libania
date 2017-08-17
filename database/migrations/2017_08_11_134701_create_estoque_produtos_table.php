<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstoqueProdutosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produto_id')->unique();
            $table->integer('movimento_entrada')->unsigned();
            $table->integer('movimento_saida')->unsigned();
            $table->integer('venda')->unigned();
            $table->integer('total')->unigned();
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estoque_produtos');
    }
}
