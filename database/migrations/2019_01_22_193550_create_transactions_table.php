<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\TransactionStatus;

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
            $table->string('hash', 60); // hash is a uniq id for each transaction
            $table->unsignedInteger('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->string('transaction_mode');
            $table->string('transaction_type');
            $table->double('amount', null, 2); // amount is an integer, it could be "dollars" or "cents"
            $table->double('pre_balance', null, 2);
            $table->double('post_balance', null, 2);
            $table->string('transaction_status')->default(TransactionStatus::QUEUED);
            $table->boolean('accepted')->default(false); // All transactions will be added in the book, some can be refused
            $table->json('meta')->nullable(); // Add all kind of meta information you need
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
        Schema::dropIfExists('transactions');
    }
}
