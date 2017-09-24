<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('compra_id')->unsigned();
            $table->integer('categoria_id')->unsigned();
            $table->integer('pessoa_id')->unsigned();
            $table->date('vencimento');
            $table->date('pagamento')->nullable();
            $table->float('total', 10, 2)->unsigned();
            $table->timestamps();

            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('CASCADE');
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
        Schema::dropIfExists('pagamentos');
    }
}
