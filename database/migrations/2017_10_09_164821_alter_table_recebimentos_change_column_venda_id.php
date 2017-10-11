<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRecebimentosChangeColumnVendaId extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recebimentos', function (Blueprint $table) {
            $table->integer('venda_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recebimentos', function (Blueprint $table) {
            $table->integer('venda_id')->unsigned()->change();
        });
    }
}
