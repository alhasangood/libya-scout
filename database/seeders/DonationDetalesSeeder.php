<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonationDetales;

class DonationDetalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DonationDetales::factory()
            ->count(5)
            ->create();
    }
}
