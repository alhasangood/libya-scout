<?php

namespace Database\Seeders;

use App\Models\DonationEntity;
use Illuminate\Database\Seeder;

class DonationEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DonationEntity::factory()
            ->count(5)
            ->create();
    }
}
