<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movement_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('amount')->unsigned();
            $table->integer('flow')->unsigned();
            $table->timestamps();

            $table->foreign('movement_id')->references('id')->on('movement')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movement_products');
    }
}
