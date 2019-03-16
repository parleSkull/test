<?php

use App\Models\Auth\User;
use Illuminate\Database\Seeder;
use App\Enums\AccountType;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
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

        // Add the master administrator, user id of 1
        $user = User::create([
            'account_type'          => AccountType::INDIVIDUAL,
            'username'        => 'admin',
            'first_name'        => 'Admin',
            'last_name'         => 'Istrator',
            'email'             => 'admin@admin.com',
            'phone_number'             => '254703796197',
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]);

        /*
         * Create Wallet
         */
        $user->wallet()->create([
            'user_uuid' => $user->uuid,
            'balance' => 0.00
        ]);

        $user = User::create([
            'account_type'          => AccountType::INSTITUTION,
            'username'        => 'backend',
            'first_name'        => 'Backend',
            'last_name'         => 'User',
            'email'             => 'executive@executive.com',
            'phone_number'             => '254703796198',
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]);

        /*
         * Create Wallet
         */
        $user->wallet()->create([
            'user_uuid' => $user->uuid,
            'balance' => 0.00
        ]);

        $user = User::create([
            'account_type'          => AccountType::INDIVIDUAL,
            'username'        => 'default',
            'first_name'        => 'Default',
            'last_name'         => 'User',
            'email'             => 'user@user.com',
            'phone_number'             => '254703796199',
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]);

        /*
         * Create Wallet
         */
        $user->wallet()->create([
            'user_uuid' => $user->uuid,
            'balance' => 0.00
        ]);

        $user = User::create([
            'account_type'          => AccountType::INDIVIDUAL,
            'username'        => 'stevem',
            'first_name'        => 'Steve',
            'last_name'         => 'Musili',
            'email'             => 'stevem@ryztek.com',
            'phone_number'             => '254703796299',
            'password'          => 'stevem',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]);

        /*
         * Create Wallet
         */
        $user->wallet()->create([
            'user_uuid' => $user->uuid,
            'balance' => 0.00
        ]);

        $this->enableForeignKeys();
    }
}
