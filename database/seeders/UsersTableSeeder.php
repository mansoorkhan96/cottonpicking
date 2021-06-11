<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'user_id' => null,
                'role_id' => User::ROLES['LANDLORD'],
                'name' => 'LandLord',
                'email' => 'landlord@example.com',
                'password' => Hash::make('123'),
            ],
            [
                'user_id' => 1,
                'role_id' => User::ROLES['FARMER'],
                'name' => 'Rasheed',
                'email' => 'farmer@example.com',
                'password' => Hash::make('123'),
            ],
            [
                'user_id' => 1,
                'role_id' => User::ROLES['LABOUR'],
                'name' => 'labour1',
                'email' => 'labour1@example.com',
                'password' => Hash::make('123'),
            ],
            [
                'user_id' => 1,
                'role_id' => User::ROLES['LABOUR'],
                'name' => 'labour2',
                'email' => 'labour2@example.com',
                'password' => Hash::make('123'),
            ],
            [
                'user_id' => 1,
                'role_id' => User::ROLES['LABOUR'],
                'name' => 'labour3',
                'email' => 'labour3@example.com',
                'password' => Hash::make('123'),
            ],
            [
                'user_id' => 1,
                'role_id' => User::ROLES['LABOUR'],
                'name' => 'labour4',
                'email' => 'labour4@example.com',
                'password' => Hash::make('123'),
            ],
            [
                'user_id' => 1,
                'role_id' => User::ROLES['LABOUR'],
                'name' => 'labour5',
                'email' => 'labour5@example.com',
                'password' => Hash::make('123'),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
