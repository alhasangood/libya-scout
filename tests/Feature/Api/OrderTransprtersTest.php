<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Transprter;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTransprtersTest extends TestCase
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
    public function it_gets_order_transprters(): void
    {
        $order = Order::factory()->create();
        $transprters = Transprter::factory()
            ->count(2)
            ->create([
                'order_id' => $order->id,
            ]);

        $response = $this->getJson(
            route('api.orders.transprters.index', $order)
        );

        $response->assertOk()->assertSee($transprters[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_order_transprters(): void
    {
        $order = Order::factory()->create();
        $data = Transprter::factory()
            ->make([
                'order_id' => $order->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.orders.transprters.store', $order),
            $data
        );

        $this->assertDatabaseHas('transprters', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $transprter = Transprter::latest('id')->first();

        $this->assertEquals($order->id, $transprter->order_id);
    }
}
