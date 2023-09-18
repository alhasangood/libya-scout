<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ScoutRegiment;

use App\Models\Order;
use App\Models\StoreHouse;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoutRegimentTest extends TestCase
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
    public function it_gets_scout_regiments_list(): void
    {
        $scoutRegiments = ScoutRegiment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.scout-regiments.index'));

        $response->assertOk()->assertSee($scoutRegiments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_scout_regiment(): void
    {
        $data = ScoutRegiment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.scout-regiments.store'), $data);

        $this->assertDatabaseHas('scout_regiments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_scout_regiment(): void
    {
        $scoutRegiment = ScoutRegiment::factory()->create();

        $storeHouse = StoreHouse::factory()->create();
        $order = Order::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'phone' => $this->faker->randomNumber(),
            'status' => $this->faker->randomNumber(),
            'store_house_id' => $storeHouse->id,
            'order_id' => $order->id,
        ];

        $response = $this->putJson(
            route('api.scout-regiments.update', $scoutRegiment),
            $data
        );

        $data['id'] = $scoutRegiment->id;

        $this->assertDatabaseHas('scout_regiments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_scout_regiment(): void
    {
        $scoutRegiment = ScoutRegiment::factory()->create();

        $response = $this->deleteJson(
            route('api.scout-regiments.destroy', $scoutRegiment)
        );

        $this->assertModelMissing($scoutRegiment);

        $response->assertNoContent();
    }
}
