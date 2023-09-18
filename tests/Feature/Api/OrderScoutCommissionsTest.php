<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\ScoutCommission;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderScoutCommissionsTest extends TestCase
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
    public function it_gets_order_scout_commissions(): void
    {
        $order = Order::factory()->create();
        $scoutCommissions = ScoutCommission::factory()
            ->count(2)
            ->create([
                'order_id' => $order->id,
            ]);

        $response = $this->getJson(
            route('api.orders.scout-commissions.index', $order)
        );

        $response->assertOk()->assertSee($scoutCommissions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_order_scout_commissions(): void
    {
        $order = Order::factory()->create();
        $data = ScoutCommission::factory()
            ->make([
                'order_id' => $order->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.orders.scout-commissions.store', $order),
            $data
        );

        $this->assertDatabaseHas('scout_commissions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $scoutCommission = ScoutCommission::latest('id')->first();

        $this->assertEquals($order->id, $scoutCommission->order_id);
    }
}
