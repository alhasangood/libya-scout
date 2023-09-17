<?php

namespace Database\Seeders;

use App\Models\TransprterType;
use Illuminate\Database\Seeder;

class TransprterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransprterType::factory()
            ->count(5)
            ->create();
    }
}
