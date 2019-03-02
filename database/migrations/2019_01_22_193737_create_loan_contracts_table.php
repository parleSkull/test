<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\AlgorithmType;

class CreateLoanContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('borrower_id');
            $table->unsignedInteger('lender_id');
            $table->morphs('contractable');
            $table->double('present_value')->default(0.00);
            $table->double('rate_per_period')->default(0.00);
            $table->integer('number_of_periods')->default(1);
            $table->string('algorithm_type')->default(AlgorithmType::Standard);
            $table->double('payment_amount')->default(0.00);
            $table->json('transactions')->nullable();
            $table->boolean('completed')->default(false);
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
        Schema::dropIfExists('loan_contracts');
    }
}
