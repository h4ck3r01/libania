<?php

use Carbon\Carbon;
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
            $table->integer('centro_id')->unsigned();
            $table->string('nome')->unique();
            $table->integer('fluxo')->unsigned();
            $table->timestamps();

            $table->foreign('centro_id')->references('id')->on('financeiro_centros')->onDelete('RESTRICT');
        });

        DB::table('financeiro_categorias')->insert(
            array(
                'centro_id' => '1',
                'nome' => 'Venda',
                'fluxo' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )
        );

        DB::table('financeiro_categorias')->insert(
            array(
                'centro_id' => '1',
                'nome' => 'Compra',
                'fluxo' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )
        );

        DB::table('financeiro_categorias')->insert(
            array(
                'centro_id' => '1',
                'nome' => 'Fiado',
                'fluxo' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )
        );
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
