<?php

use App\Models\Investment\InvestmentPayment;
use Illuminate\Database\Seeder;

/**
 * Class InvestmentPaymentTableSeeder.
 */
class InvestmentPaymentTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        InvestmentPayment::create([
            'investment_id'           => 1,
            'payment_number'          => 1,
            'reinvestment_value'        => 512.00,
            'service_fee'         => 50.0,
            'beginning_balance'             => 600.00,
            'interest_earned'             => 80.00
        ]);

        InvestmentPayment::create([
            'investment_id'           => 2,
            'payment_number'          => 1,
            'reinvestment_value'        => 512.00,
            'service_fee'         => 50.0,
            'beginning_balance'             => 600.00,
            'interest_earned'             => 80.00
        ]);

        InvestmentPayment::create([
            'investment_id'           => 3,
            'payment_number'          => 1,
            'reinvestment_value'        => 512.00,
            'service_fee'         => 50.0,
            'beginning_balance'             => 600.00,
            'interest_earned'             => 80.00
        ]);

        $this->enableForeignKeys();
    }
}
