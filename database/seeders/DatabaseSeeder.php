<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $this->call(ScoutCommissionSeeder::class);
        $this->call(ScoutRegimentSeeder::class);
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(DonationSeeder::class);
        $this->call(DonationDetalesSeeder::class);
        $this->call(DonationEntitySeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(ItemDetailsSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(RollSeeder::class);
        $this->call(ScoutCommissionSeeder::class);
        $this->call(ScoutRegimentSeeder::class);
        $this->call(StoreHouseSeeder::class);
        $this->call(TransprterTypeSeeder::class);
        $this->call(TransprterSeeder::class);

        $this->call(UserSeeder::class);
    }
}
