<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFiadoPessoasAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fiado_pessoas', function (Blueprint $table) {
            $table->date('data_ultimo')->nullable();
            $table->float('total_ultimo', 10, 2)->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fiado_pessoas', function (Blueprint $table) {
            $table->dropColumn('data_ultimo');
            $table->dropColumn('total_ultimo');
        });
    }
}
