<?php

namespace Database\Seeders;

use App\Models\StoreHouse;
use Illuminate\Database\Seeder;

class StoreHouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreHouse::factory()
            ->count(5)
            ->create();
    }
}
