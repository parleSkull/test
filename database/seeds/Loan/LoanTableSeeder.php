<?php

use App\Models\Loan\Loan;
use Illuminate\Database\Seeder;

/**
 * Class LoanTableSeeder.
 */
class LoanTableSeeder extends Seeder
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

        Loan::create([
            'user_id'           => 4,
            'requested_value'          => 5000.00
        ]);

        Loan::create([
            'user_id'           => 4,
            'requested_value'          => 4000.00
        ]);

        Loan::create([
            'user_id'           => 4,
            'requested_value'          => 3000.00
        ]);

        $this->enableForeignKeys();
    }
}
