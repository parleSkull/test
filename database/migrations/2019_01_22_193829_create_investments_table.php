<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\DealStatus;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('user_uuid')->nullable();
            $table->string('alias')->nullable();
            $table->double('initial_value',null, 2)->default(0.00);
            $table->double('current_value',null, 2)->default(0.00);
            $table->double('interest_rate',null, 2)->default(0.00);  // pm
            $table->string('deal_status')->default(DealStatus::QUEUED);
            $table->unsignedInteger('next_repayment_id')->nullable();
            $table->double('next_repayment_value',null, 2)->nullable();
            $table->double('cumulative_interest',null, 2)->nullable();
            $table->double('service_charge_value',null, 2)->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('next_payment_at')->nullable();
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
        Schema::dropIfExists('investments');
    }
}
