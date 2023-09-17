<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;

use App\Models\Transprter;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
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
    public function it_gets_orders_list(): void
    {
        $orders = Order::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.orders.index'));

        $response->assertOk()->assertSee($orders[0]->orederNumber);
    }

    /**
     * @test
     */
    public function it_stores_the_order(): void
    {
        $data = Order::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.orders.store'), $data);

        unset($data['id']);

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_order(): void
    {
        $order = Order::factory()->create();

        $transprter = Transprter::factory()->create();

        $data = [
            'transprter_id' => $transprter->id,
        ];

        $response = $this->putJson(route('api.orders.update', $order), $data);

        unset($data['id']);

        $data['orederNumber'] = $order->orederNumber;

        $this->assertDatabaseHas('orders', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->deleteJson(route('api.orders.destroy', $order));

        $this->assertModelMissing($order);

        $response->assertNoContent();
    }
}
