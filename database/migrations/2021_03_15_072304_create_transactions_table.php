<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->datetime('timeout');
            $table->string('address');
            $table->string('regency');
            $table->string('province');
            $table->double('total');
            $table->double('shipping_cost');
            $table->double('sub_total');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('courier_id')->unsigned();
            $table->string('proof_of_payment');
            $table->enum('status',['unverified','verified','delivered','success','expired','canceled']);
            $table->timestamps();

            
            $table->foreign('courier_id')->references('id')->on('couriers');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
