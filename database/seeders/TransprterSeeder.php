<?php

namespace Database\Seeders;

use App\Models\Transprter;
use Illuminate\Database\Seeder;

class TransprterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transprter::factory()
            ->count(5)
            ->create();
    }
}
