<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\DealStatus;

class CreateInvestmentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('investment_id')->nullable();
            $table->foreign('investment_id')->references('id')->on('investments')->onDelete('cascade');
            $table->string('investment_uuid')->nullable();
            $table->integer('payment_number')->nullable();
            $table->double('reinvestment_value')->default(0.00);
            $table->double('service_fee')->default(0.00);
            $table->double('beginning_balance')->default(0.00);
            $table->double('interest_earned')->default(0.00);
            $table->double('withdrawal')->default(0.00);
            $table->double('ending_balance')->default(0.00);
            $table->string('deal_status')->default(DealStatus::QUEUED);
            $table->timestamp('start_at')->nullable();
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
        Schema::dropIfExists('investment_payments');
    }
}
