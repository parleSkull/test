<?php

use App\Models\Investment\Investment;
use Illuminate\Database\Seeder;
use App\Models\Auth\User;

/**
 * Class InvestmentTableSeeder.
 */
class InvestmentTableSeeder extends Seeder
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

        Investment::create([
            'user_id'           => 4,
            'user_uuid'  => User::find(4)->uuid,
            'initial_value'          => 5000.00,
            'current_value'        => 5000.00,
            'interest_rate'         => 18
        ]);

        Investment::create([
            'user_id'           => 4,
            'user_uuid'  => User::find(4)->uuid,
            'initial_value'          => 6000.00,
            'current_value'        => 6000.00,
            'interest_rate'         => 18
        ]);

        Investment::create([
            'user_id'           => 4,
            'user_uuid'  => User::find(4)->uuid,
            'initial_value'          => 8000.00,
            'current_value'        => 8000.00,
            'interest_rate'         => 18
        ]);

        $this->enableForeignKeys();
    }
}
