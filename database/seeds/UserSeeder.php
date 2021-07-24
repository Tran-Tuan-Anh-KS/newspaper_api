<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role'   => 1,
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@gmail.com',
                'password' => Hash::make('12345678'),
                'role'   => 2,
            ],
            [
                'name' => 'Visitor',
                'email' => 'visitor@gmail.com',
                'password' => Hash::make('12345678'),
                'role'   => 3,
            ],
        ]);
    }
}
