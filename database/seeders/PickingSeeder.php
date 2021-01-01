<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PickingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pickings')->insert([
            [
                'pickingnumber_id' => 1,
                'labour_id' => 3,
                'date' => '2020-10-1',
                'kgs_picked' => 49,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 4,
                'date' => '2020-10-1',
                'kgs_picked' => 40,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 5,
                'date' => '2020-10-1',
                'kgs_picked' => 39,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 6,
                'date' => '2020-10-1',
                'kgs_picked' => 19,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 7,
                'date' => '2020-10-1',
                'kgs_picked' => 9,
            ],

            [
                'pickingnumber_id' => 1,
                'labour_id' => 3,
                'date' => '2020-10-2',
                'kgs_picked' => 59,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 4,
                'date' => '2020-10-2',
                'kgs_picked' => 60,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 5,
                'date' => '2020-10-2',
                'kgs_picked' => 29,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 6,
                'date' => '2020-10-2',
                'kgs_picked' => 29,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 7,
                'date' => '2020-10-2',
                'kgs_picked' => 19,
            ],

            [
                'pickingnumber_id' => 1,
                'labour_id' => 3,
                'date' => '2020-10-3',
                'kgs_picked' => 59,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 4,
                'date' => '2020-10-3',
                'kgs_picked' => 70,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 5,
                'date' => '2020-10-3',
                'kgs_picked' => 19,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 6,
                'date' => '2020-10-3',
                'kgs_picked' => 29,
            ],
            [
                'pickingnumber_id' => 1,
                'labour_id' => 7,
                'date' => '2020-10-3',
                'kgs_picked' => 83,
            ],
        ]);
    }
}
