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
            $table->integer('produto_id')->unsigned();
            $table->integer('movimento_entrada')->default(0);
            $table->integer('movimento_saida')->default(0);
            $table->integer('compra')->default(0);
            $table->integer('venda')->default(0);
            $table->integer('total')->default(0);
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
