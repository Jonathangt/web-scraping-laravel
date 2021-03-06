<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::created([
            'name' => 'jonathan',
            'email' => 'test@test.com',
            'password' => Hash::make(123456789),
        ]);
    }
}
