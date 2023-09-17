<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\StoreHouse;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreHouseOrdersTest extends TestCase
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
    public function it_gets_store_house_orders(): void
    {
        $storeHouse = StoreHouse::factory()->create();
        $order = Order::factory()->create();

        $storeHouse->orders()->attach($order);

        $response = $this->getJson(
            route('api.store-houses.orders.index', $storeHouse)
        );

        $response->assertOk()->assertSee($order->orederNumber);
    }

    /**
     * @test
     */
    public function it_can_attach_orders_to_store_house(): void
    {
        $storeHouse = StoreHouse::factory()->create();
        $order = Order::factory()->create();

        $response = $this->postJson(
            route('api.store-houses.orders.store', [$storeHouse, $order])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $storeHouse
                ->orders()
                ->where('orders.orederNumber', $order->orederNumber)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_orders_from_store_house(): void
    {
        $storeHouse = StoreHouse::factory()->create();
        $order = Order::factory()->create();

        $response = $this->deleteJson(
            route('api.store-houses.orders.store', [$storeHouse, $order])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $storeHouse
                ->orders()
                ->where('orders.orederNumber', $order->orederNumber)
                ->exists()
        );
    }
}
