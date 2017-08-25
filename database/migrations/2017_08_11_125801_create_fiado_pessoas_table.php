<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiadoPessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiado_pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pessoa_id')->unsigned();
            $table->float('total', 10, 2)->unsigned()->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('fiado_clientes');
    }
}
