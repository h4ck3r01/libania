<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_id')->index();
            $table->integer('product_id')->index();
            $table->float('price', 10, 2)->unsigned();
            $table->integer('amount')->unsigned();
            $table->float('total', 10, 2)->unsigned();
            $table->timestamps();

            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('CASCADE');
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
        Schema::dropIfExists('purchase_products');
    }
}
