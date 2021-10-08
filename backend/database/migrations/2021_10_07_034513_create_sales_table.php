<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('code_transaksi');
            $table->date('tanggal_transaksi');
            $table->integer('id_customer')->unsigned();
            $table->bigInteger('total_diskon');
            $table->bigInteger('total_harga');
            $table->bigInteger('total_bayar');
            $table->foreign('id_customer')->references('id_customer')->on('customers')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
