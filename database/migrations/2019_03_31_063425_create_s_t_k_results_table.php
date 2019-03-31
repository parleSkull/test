<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSTKResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_t_k_results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('s_t_k_request_id')->nullable();
            $table->foreign('s_t_k_request_id')->references('id')->on('s_t_k_requests')->onDelete('cascade');
            $table->string('merchantRequestID');
            $table->string('checkoutRequestID');
            $table->integer('resultCode');
            $table->string('resultDesc')->nullable();
            $table->double('amount')->nullable();
            $table->string('mpesaReceiptNumber')->nullable();
            $table->double('balance')->nullable();
            $table->string('transactionDate')->nullable();
            $table->string('phoneNumber')->nullable();
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
        Schema::dropIfExists('s_t_k_results');
    }
}
