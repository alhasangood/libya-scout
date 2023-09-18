<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Donation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderDonationsTest extends TestCase
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
    public function it_gets_order_donations(): void
    {
        $order = Order::factory()->create();
        $donations = Donation::factory()
            ->count(2)
            ->create([
                'order_id' => $order->id,
            ]);

        $response = $this->getJson(route('api.orders.donations.index', $order));

        $response->assertOk()->assertSee($donations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_order_donations(): void
    {
        $order = Order::factory()->create();
        $data = Donation::factory()
            ->make([
                'order_id' => $order->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.orders.donations.store', $order),
            $data
        );

        $this->assertDatabaseHas('donations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $donation = Donation::latest('id')->first();

        $this->assertEquals($order->id, $donation->order_id);
    }
}
