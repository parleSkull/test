<?php

use App\Models\Loan\LoanRequest;
use Illuminate\Database\Seeder;

/**
 * Class LoanRequestTableSeeder.
 */
class LoanRequestTableSeeder extends Seeder
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

        LoanRequest::create([
            'user_id'           => 4,
            'present_value'          => 5000.00,
            'number_of_periods'         => 8,
            'period_type'             => \App\Enums\PeriodType::MONTHLY,
            'granted'            => false,
        ]);

        LoanRequest::create([
            'user_id'           => 4,
            'present_value'          => 4000.00,
            'number_of_periods'         => 6,
            'period_type'             => \App\Enums\PeriodType::MONTHLY,
            'granted'            => false,
        ]);

        LoanRequest::create([
            'user_id'           => 4,
            'present_value'          => 3000.00,
            'number_of_periods'         => 2,
            'period_type'             => \App\Enums\PeriodType::MONTHLY,
            'granted'            => false,
        ]);

        $this->enableForeignKeys();
    }
}
