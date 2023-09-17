<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\StoreHouse;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderStoreHousesTest extends TestCase
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
    public function it_gets_order_store_houses(): void
    {
        $order = Order::factory()->create();
        $storeHouse = StoreHouse::factory()->create();

        $order->storeHouses()->attach($storeHouse);

        $response = $this->getJson(
            route('api.orders.store-houses.index', $order)
        );

        $response->assertOk()->assertSee($storeHouse->name);
    }

    /**
     * @test
     */
    public function it_can_attach_store_houses_to_order(): void
    {
        $order = Order::factory()->create();
        $storeHouse = StoreHouse::factory()->create();

        $response = $this->postJson(
            route('api.orders.store-houses.store', [$order, $storeHouse])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $order
                ->storeHouses()
                ->where('store_houses.id', $storeHouse->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_store_houses_from_order(): void
    {
        $order = Order::factory()->create();
        $storeHouse = StoreHouse::factory()->create();

        $response = $this->deleteJson(
            route('api.orders.store-houses.store', [$order, $storeHouse])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $order
                ->storeHouses()
                ->where('store_houses.id', $storeHouse->id)
                ->exists()
        );
    }
}
