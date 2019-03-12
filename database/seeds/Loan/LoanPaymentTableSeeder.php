<?php

use App\Models\Loan\LoanPayment;
use Illuminate\Database\Seeder;

/**
 * Class LoanPaymentTableSeeder.
 */
class LoanPaymentTableSeeder extends Seeder
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

        LoanPayment::create([
            'loan_id'           => 1,
            'payment_number'          => 1,
            'payment_value'        => 500.00,
            'pre_balance'         => 1000.0,
            'post_balance'             => 500.00
        ]);

        LoanPayment::create([
            'loan_id'           => 2,
            'payment_number'          => 1,
            'payment_value'        => 500.00,
            'pre_balance'         => 1000.0,
            'post_balance'             => 500.00
        ]);

        LoanPayment::create([
            'loan_id'           => 3,
            'payment_number'          => 1,
            'payment_value'        => 500.00,
            'pre_balance'         => 1000.0,
            'post_balance'             => 500.00
        ]);

        LoanPayment::create([
            'loan_id'           => 1,
            'payment_number'          => 1,
            'payment_value'        => 500.00,
            'pre_balance'         => 1000.0,
            'post_balance'             => 500.00
        ]);

        LoanPayment::create([
            'loan_id'           => 2,
            'payment_number'          => 1,
            'payment_value'        => 500.00,
            'pre_balance'         => 1000.0,
            'post_balance'             => 500.00
        ]);

        $this->enableForeignKeys();
    }
}
