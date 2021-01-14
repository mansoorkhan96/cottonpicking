<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PickingnumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pickingnumbers')->insert([
            [
                'landlord_id' => 1,
                // 'season_id' => 1,
                'farmer_id' => 2,
                'title' => 'Picking-1',
                'sell_per_kg' => 112.5,
                'labour_pay_per_kg' => 12.5,
            ],
            [
                'landlord_id' => 1,
                // 'season_id' => 1,
                'farmer_id' => 2,
                'title' => 'Picking-2',
                'sell_per_kg' => 114.5,
                'labour_pay_per_kg' => 12.5,
            ],
        ]);
    }
}
