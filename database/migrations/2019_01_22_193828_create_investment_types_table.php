<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('interest_rate_pa')->default(0.00);
            $table->double('interest_rate_pm')->default(0.00);
            $table->integer('num_payments_pa')->default(12);
            $table->double('service_charge_rate_pm')->default(0.00);
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
        Schema::dropIfExists('investment_types');
    }
}
