<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_details', function (Blueprint $table) {
            $table->bigIncrements('id_sales_detail');
            $table->bigInteger('code_transaksi')->unsigned();
            $table->integer('id_item')->unsigned();
            $table->integer('qty');
            $table->foreign('code_transaksi')->references('code_transaksi')->on('sales')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_item')->references('id_item')->on('items')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_details');
    }
}
