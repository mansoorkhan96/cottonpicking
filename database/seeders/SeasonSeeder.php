<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seasons')->insert([
            [
                'user_id' => 1,
                'name' => 'Season-1',
                'from_to' => '2019-2020',
            ],
        ]);
    }
}
