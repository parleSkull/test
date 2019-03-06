<?php

use App\Models\Loan\LoanContract;
use Illuminate\Database\Seeder;
use App\Enums\AlgorithmType;
use App\Enums\PeriodType;
use App\Enums\DealStatus;

/**
 * Class LoanOfferTableSeeder.
 */
class LoanContractTableSeeder extends Seeder
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

        LoanContract::create([
            'consumer_id'           => 4,
            'investor_id'    => 3,
            'deal_origin_id' => 1,
            'deal_origin_type' => "LoanOffer",
            'present_value'          => 4000.00,
            'rate_per_period'        => 2,
            'number_of_periods'         => 4,
            'algorithm_type'             => AlgorithmType::Standard,
            'period_type'             => PeriodType::MONTHLY,
            'repayment_value' => 6000.00,
            'status'            => DealStatus::OPEN
        ]);

        LoanContract::create([
            'consumer_id'           => 2,
            'investor_id'    => 3,
            'deal_origin_id' => 2,
            'deal_origin_type' => "LoanRequest",
            'present_value'          => 3000.00,
            'rate_per_period'        => 2,
            'number_of_periods'         => 4,
            'algorithm_type'             => AlgorithmType::Standard,
            'period_type'             => PeriodType::MONTHLY,
            'repayment_value' => 8000.00,
            'status'            => DealStatus::SETTLED
        ]);

        LoanContract::create([
            'consumer_id'           => 4,
            'investor_id'    => 2,
            'deal_origin_id' => 3,
            'deal_origin_type' => "LoanOffer",
            'present_value'          => 2000.00,
            'rate_per_period'        => 2,
            'number_of_periods'         => 4,
            'algorithm_type'             => AlgorithmType::Standard,
            'period_type'             => PeriodType::MONTHLY,
            'repayment_value' => 5000.00,
            'status'            => DealStatus::OPEN
        ]);

        LoanContract::create([
            'consumer_id'           => 4,
            'investor_id'    => 2,
            'deal_origin_id' => 1,
            'deal_origin_type' => "LoanRequest",
            'present_value'          => 1500.00,
            'rate_per_period'        => 2,
            'number_of_periods'         => 4,
            'algorithm_type'             => AlgorithmType::Standard,
            'period_type'             => PeriodType::MONTHLY,
            'repayment_value' => 5600.00,
            'status'            => DealStatus::OPEN
        ]);

        LoanContract::create([
            'consumer_id'           => 1,
            'investor_id'    => 3,
            'deal_origin_id' => 3,
            'deal_origin_type' => "LoanRequest",
            'present_value'          => 4444.00,
            'rate_per_period'        => 2,
            'number_of_periods'         => 4,
            'algorithm_type'             => AlgorithmType::Standard,
            'period_type'             => PeriodType::MONTHLY,
            'repayment_value' => 8888.00,
            'status'            => DealStatus::OPEN
        ]);

        $this->enableForeignKeys();
    }
}
