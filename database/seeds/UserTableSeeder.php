<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::insert([
            'first_name' => 'Gaelle',
            'last_name' => 'Hardy',
            'email' => 'gaelle_hardy1@hotmail.com',
            'password' => bcrypt('Dutsvandezee94')
        ]);
    }
}
