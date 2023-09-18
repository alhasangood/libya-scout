<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\StoreHouse;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreHouseItemsTest extends TestCase
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
    public function it_gets_store_house_items(): void
    {
        $storeHouse = StoreHouse::factory()->create();
        $items = Item::factory()
            ->count(2)
            ->create([
                'store_house_id' => $storeHouse->id,
            ]);

        $response = $this->getJson(
            route('api.store-houses.items.index', $storeHouse)
        );

        $response->assertOk()->assertSee($items[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_store_house_items(): void
    {
        $storeHouse = StoreHouse::factory()->create();
        $data = Item::factory()
            ->make([
                'store_house_id' => $storeHouse->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.store-houses.items.store', $storeHouse),
            $data
        );

        $this->assertDatabaseHas('items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $item = Item::latest('id')->first();

        $this->assertEquals($storeHouse->id, $item->store_house_id);
    }
}
