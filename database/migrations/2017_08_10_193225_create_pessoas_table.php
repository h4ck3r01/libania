<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_tipos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
        });

        DB::table('pessoa_tipos')->insert(
            array(
                'nome' => 'Cliente',
            )
        );

        DB::table('pessoa_tipos')->insert(
            array(
                'nome' => 'Fornecedor',
            )
        );

        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('telefone');
            $table->string('email')->nullable();
            $table->integer('tipo_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tipo_id')->references('id')->on('pessoa_tipos')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
        Schema::dropIfExists('pessoa_tipos');
    }
}
