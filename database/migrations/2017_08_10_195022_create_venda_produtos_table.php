<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendaProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venda_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->integer('quantidade')->unsigned();
            $table->float('total', 10, 2)->unsigned();
            $table->timestamps();

            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('CASCADE');
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
        Schema::dropIfExists('venda_produtos');
    }
}
