<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSTKSuccessResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_t_k_success_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MerchantRequestID');
            $table->string('CheckoutRequestID');
            $table->string('ResponseDescription');
            $table->integer('ResponseCode');
            $table->string('CustomerMessage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_t_k_success_responses');
    }
}
