<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\Order;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderItemsTest extends TestCase
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
    public function it_gets_order_items(): void
    {
        $order = Order::factory()->create();
        $item = Item::factory()->create();

        $order->items()->attach($item);

        $response = $this->getJson(route('api.orders.items.index', $order));

        $response->assertOk()->assertSee($item->name);
    }

    /**
     * @test
     */
    public function it_can_attach_items_to_order(): void
    {
        $order = Order::factory()->create();
        $item = Item::factory()->create();

        $response = $this->postJson(
            route('api.orders.items.store', [$order, $item])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $order
                ->items()
                ->where('items.id', $item->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_items_from_order(): void
    {
        $order = Order::factory()->create();
        $item = Item::factory()->create();

        $response = $this->deleteJson(
            route('api.orders.items.store', [$order, $item])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $order
                ->items()
                ->where('items.id', $item->id)
                ->exists()
        );
    }
}
