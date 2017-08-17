<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptmentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiptments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_id')->index();
            $table->integer('category_id')->index();
            $table->integer('client_id')->index()->nullable();
            $table->date('payment')->nullable();
            $table->float('total', 10, 2)->unsigned();
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('RESTRICT');
            $table->foreign('category_id')->references('id')->on('financial_categories')->onDelete('RESTRICT');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receiptments');
    }
}
