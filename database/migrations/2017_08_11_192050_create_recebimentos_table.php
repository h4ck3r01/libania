<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecebimentosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recebimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venda_id')->unsigned();
            $table->integer('categoria_id')->unsigned();
            $table->integer('pessoa_id')->unsigned()->nullable();
            $table->date('data');
            $table->float('total', 10, 2)->unsigned();
            $table->timestamps();

            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('CASCADE');
            $table->foreign('categoria_id')->references('id')->on('financeiro_categorias')->onDelete('RESTRICT');
            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recebimentos');
    }
}
