<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Transprter;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransprterOrdersTest extends TestCase
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
    public function it_gets_transprter_orders(): void
    {
        $transprter = Transprter::factory()->create();
        $orders = Order::factory()
            ->count(2)
            ->create([
                'transprter_id' => $transprter->id,
            ]);

        $response = $this->getJson(
            route('api.transprters.orders.index', $transprter)
        );

        $response->assertOk()->assertSee($orders[0]->orederNumber);
    }

    /**
     * @test
     */
    public function it_stores_the_transprter_orders(): void
    {
        $transprter = Transprter::factory()->create();
        $data = Order::factory()
            ->make([
                'transprter_id' => $transprter->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.transprters.orders.store', $transprter),
            $data
        );

        unset($data['id']);

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $order = Order::latest('orederNumber')->first();

        $this->assertEquals($transprter->id, $order->transprter_id);
    }
}
