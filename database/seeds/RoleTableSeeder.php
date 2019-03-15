<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::insert([
            'slug' => 'developer',
            'name' => 'Developer',
        ]);

        \App\Role::insert([
            'slug' => 'management',
            'name' => 'Management',
        ]);

        \App\Role::insert([
            'slug' => 'employee',
            'name' => 'Medewerker',
        ]);
    }
}
