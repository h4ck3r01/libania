<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('venda_formas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
        });

        DB::table('venda_formas')->insert(
            array(
                'nome' => 'Dinheiro',
            )
        );

        DB::table('venda_formas')->insert(
            array(
                'nome' => 'Cartão de Débito',
            )
        );

        DB::table('venda_formas')->insert(
            array(
                'nome' => 'Cartão de Crédito',
            )
        );

        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('fiado')->nullable();
            $table->integer('pessoa_id')->unsigned()->nullable();
            $table->integer('forma_id')->unsigned();
            $table->float('desconto', 10, 2)->unsigned();
            $table->float('total', 10, 2)->unsigned();
            $table->timestamps();

            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete('RESTRICT');
            $table->foreign('forma_id')->references('id')->on('venda_formas')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
        Schema::dropIfExists('venda_formas');
    }
}