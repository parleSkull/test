<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\DealStatus;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('user_uuid');
            $table->string('alias')->nullable();
            $table->string('purpose')->nullable();
            $table->double('requested_value',null, 2)->default(0.00);
            $table->double('disbursed_value',null, 2)->default(0.00);
            $table->double('service_charge_value',null, 2)->default(0.00);
            $table->double('repayment_value',null, 2)->default(0.00);
            $table->double('interest_rate',null, 2)->default(0.00);
            $table->double('interest_value',null, 2)->default(0.00);
            $table->integer('number_of_payments')->default(0);
            $table->string('deal_status')->default(DealStatus::QUEUED);
            $table->unsignedInteger('next_repayment_id')->nullable();
            $table->double('next_repayment_value',null, 2)->default(0.00);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('due_at')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
