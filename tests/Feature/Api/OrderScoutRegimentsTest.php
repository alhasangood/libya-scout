<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\ScoutRegiment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderScoutRegimentsTest extends TestCase
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
    public function it_gets_order_scout_regiments(): void
    {
        $order = Order::factory()->create();
        $scoutRegiments = ScoutRegiment::factory()
            ->count(2)
            ->create([
                'order_id' => $order->id,
            ]);

        $response = $this->getJson(
            route('api.orders.scout-regiments.index', $order)
        );

        $response->assertOk()->assertSee($scoutRegiments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_order_scout_regiments(): void
    {
        $order = Order::factory()->create();
        $data = ScoutRegiment::factory()
            ->make([
                'order_id' => $order->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.orders.scout-regiments.store', $order),
            $data
        );

        $this->assertDatabaseHas('scout_regiments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $scoutRegiment = ScoutRegiment::latest('id')->first();

        $this->assertEquals($order->id, $scoutRegiment->order_id);
    }
}
