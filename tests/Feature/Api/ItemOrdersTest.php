<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\Order;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemOrdersTest extends TestCase
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
    public function it_gets_item_orders(): void
    {
        $item = Item::factory()->create();
        $order = Order::factory()->create();

        $item->orders()->attach($order);

        $response = $this->getJson(route('api.items.orders.index', $item));

        $response->assertOk()->assertSee($order->orederNumber);
    }

    /**
     * @test
     */
    public function it_can_attach_orders_to_item(): void
    {
        $item = Item::factory()->create();
        $order = Order::factory()->create();

        $response = $this->postJson(
            route('api.items.orders.store', [$item, $order])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $item
                ->orders()
                ->where('orders.orederNumber', $order->orederNumber)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_orders_from_item(): void
    {
        $item = Item::factory()->create();
        $order = Order::factory()->create();

        $response = $this->deleteJson(
            route('api.items.orders.store', [$item, $order])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $item
                ->orders()
                ->where('orders.orederNumber', $order->orederNumber)
                ->exists()
        );
    }
}
