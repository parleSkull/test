<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSTKRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_t_k_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('user_uuid')->nullable();
            $table->integer('BusinessShortCode')->nullable();
            $table->string('Timestamp')->nullable();
            $table->string('TransactionType')->nullable();
            $table->double('Amount')->nullable();
            $table->string('PhoneNumber')->nullable();
            $table->string('AccountReference')->nullable();
            $table->nullableMorphs('response');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_t_k_requests');
    }
}
