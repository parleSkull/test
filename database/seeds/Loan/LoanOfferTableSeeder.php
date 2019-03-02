<?php

use App\Models\Loan\LoanOffer;
use Illuminate\Database\Seeder;
use App\Enums\AlgorithmType;

/**
 * Class LoanOfferTableSeeder.
 */
class LoanOfferTableSeeder extends Seeder
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

        LoanOffer::create([
            'user_id'           => 4,
            'present_value'          => 5000.00,
            'rate_per_period'        => 2,
            'number_of_periods'         => 4,
            'algorithm_type'             => AlgorithmType::Standard,
            'period_type'             => \App\Enums\PeriodType::MONTHLY,
            'repayment_value' => 6000.00,
            'funded'            => true,
        ]);

        LoanOffer::create([
            'user_id'           => 4,
            'present_value'          => 4000.00,
            'rate_per_period'        => 3,
            'number_of_periods'         => 7,
            'algorithm_type'             => AlgorithmType::Standard,
            'period_type'             => \App\Enums\PeriodType::MONTHLY,
            'repayment_value' => 7000.00,
            'funded'            => true,
        ]);

        LoanOffer::create([
            'user_id'           => 4,
            'present_value'          => 9000.00,
            'rate_per_period'        => 7,
            'number_of_periods'         => 3,
            'algorithm_type'             => AlgorithmType::Standard,
            'period_type'             => \App\Enums\PeriodType::MONTHLY,
            'repayment_value' => 8000.00,
            'funded'            => true,
        ]);

        $this->enableForeignKeys();
    }
}
