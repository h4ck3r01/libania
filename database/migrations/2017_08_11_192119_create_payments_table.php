<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_id')->index();
            $table->integer('category_id')->index();
            $table->integer('supplier_id')->index()->nullable();
            $table->date('payment')->nullable();
            $table->float('total', 10, 2)->unsigned();
            $table->timestamps();

            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('RESTRICT');
            $table->foreign('category_id')->references('id')->on('financial_categories')->onDelete('RESTRICT');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
