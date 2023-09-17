<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ScoutCommission;

class ScoutCommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScoutCommission::factory()
            ->count(5)
            ->create();
    }
}
