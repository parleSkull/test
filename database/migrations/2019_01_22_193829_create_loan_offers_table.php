<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\AlgorithmType;

class CreateLoanOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('present_value')->default(0.00);
            $table->double('rate_per_period')->default(0.00);
            $table->integer('number_of_periods')->default(1);
            $table->string('period_type')->default(\App\Enums\PeriodType::MONTHLY);
            $table->string('algorithm_type')->default(AlgorithmType::Standard);
            $table->double('repayment_value')->default(0.00);
            $table->boolean('funded')->default(false);
            $table->boolean('open')->default(true);
            $table->boolean('accepted')->default(false);
            $table->json('watchers')->nullable();
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
        Schema::dropIfExists('loan_offers');
    }
}
