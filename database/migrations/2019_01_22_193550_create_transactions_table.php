<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\TransactionType;

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
            $table->increments('id');
            $table->unsignedInteger('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->double('amount'); // amount is an integer, it could be "dollars" or "cents"
            $table->string('hash', 60); // hash is a uniqid for each transaction
            $table->tinyInteger('transaction_type')->unsigned()->default(TransactionType::Unspecified);
            $table->boolean('accepted'); // All transactions will be added in the book, some can be refused
            $table->json('meta')->nullable(); // Add all kind of meta information you need
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
        Schema::dropIfExists('transactions');
    }
}
