<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceiroCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financeiro_categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('centro_id')->index();
            $table->string('nome')->unique();
            $table->integer('fluxo')->unsigned();
            $table->timestamps();

            $table->foreign('centro_id')->references('id')->on('financeiro_centros')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financeiro_categorias');
    }
}
