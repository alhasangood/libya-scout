<?php

namespace Database\Seeders;

use App\Models\Roll;
use Illuminate\Database\Seeder;

class RollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roll::factory()
            ->count(5)
            ->create();
    }
}
