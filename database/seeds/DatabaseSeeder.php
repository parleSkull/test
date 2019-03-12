<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'cache',
            'jobs',
            'sessions',
        ]);

        $this->call(AuthTableSeeder::class);
        $this->call(InvestmentTypeTableSeeder::class);
        $this->call(LoanTypeTableSeeder::class);
        $this->call(InvestmentTableSeeder::class);
        $this->call(InvestmentPaymentTableSeeder::class);
        $this->call(LoanTableSeeder::class);
        $this->call(LoanPaymentTableSeeder::class);

        Model::reguard();
    }
}
