<?php

use App\Models\Company\LoanType;
use Illuminate\Database\Seeder;

/**
 * Class LoanTypeTableSeeder.
 */
class LoanTypeTableSeeder extends Seeder
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

        LoanType::create([
            'name'                    => 'Standard',
            'interest_rate_pa'        => 19.00,
            'interest_rate_pm'        => 1.50,
            'service_charge_rate_pm'  => 5.00
        ]);

        $this->enableForeignKeys();
    }
}
