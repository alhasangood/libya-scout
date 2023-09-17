<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Donation;
use App\Models\StoreHouse;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreHouseDonationsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_store_house_donations(): void
    {
        $storeHouse = StoreHouse::factory()->create();
        $donations = Donation::factory()
            ->count(2)
            ->create([
                'store_house_id' => $storeHouse->id,
            ]);

        $response = $this->getJson(
            route('api.store-houses.donations.index', $storeHouse)
        );

        $response->assertOk()->assertSee($donations[0]->description);
    }

    /**
     * @test
     */
    public function it_stores_the_store_house_donations(): void
    {
        $storeHouse = StoreHouse::factory()->create();
        $data = Donation::factory()
            ->make([
                'store_house_id' => $storeHouse->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.store-houses.donations.store', $storeHouse),
            $data
        );

        unset($data['qtuantity']);
        unset($data['item_id']);
        unset($data['store_house_id']);

        $this->assertDatabaseHas('donations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $donation = Donation::latest('id')->first();

        $this->assertEquals($storeHouse->id, $donation->store_house_id);
    }
}
