<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraProdutosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('compra_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->float('preco', 10, 2)->unsigned();
            $table->integer('quantidade')->unsigned();
            $table->float('total', 10, 2)->unsigned();
            $table->timestamps();

            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('CASCADE');
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
        Schema::dropIfExists('compra_produtos');
    }
}
