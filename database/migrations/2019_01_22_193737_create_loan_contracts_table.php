<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\AlgorithmType;
use App\Enums\DealStatus;
use App\Enums\PeriodType;

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
            $table->unsignedInteger('consumer_id');
            $table->unsignedInteger('investor_id');
            $table->morphs('deal_origin');
            $table->double('present_value')->default(0.00);
            $table->string('period_type')->default(PeriodType::MONTHLY);
            $table->double('rate_per_period')->default(0.00);
            $table->integer('number_of_periods')->default(1);
            $table->string('algorithm_type')->default(AlgorithmType::Standard);
            $table->double('repayment_value')->default(0.00);
            $table->string('status')->default(DealStatus::OPEN);
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
