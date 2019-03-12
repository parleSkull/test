<?php

use App\Models\Company\InvestmentType;
use Illuminate\Database\Seeder;

/**
 * Class InvestmentTypeTableSeeder.
 */
class InvestmentTypeTableSeeder extends Seeder
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

        InvestmentType::create([
            'name'                    => 'Standard',
            'interest_rate_pa'        => 18.00,
            'interest_rate_pm'        => 1.50,
            'num_payments_pa'         => 12,
            'service_charge_rate_pm'  => 5.00
        ]);

        $this->enableForeignKeys();
    }
}
