<?php

namespace Database\Seeders;

use App\Models\ScoutRegiment;
use Illuminate\Database\Seeder;

class ScoutRegimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScoutRegiment::factory()
            ->count(5)
            ->create();
    }
}
