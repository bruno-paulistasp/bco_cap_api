<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Bruno',
            'email' => 'bruno@teste.com',
            'password' => bcrypt('password'),
            'balance' => 0,
            'agency' => '0001',
            'account' => '12345678',
        ]);
    }
}
