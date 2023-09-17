<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\StoreHouse;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreHouseTest extends TestCase
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
    public function it_gets_store_houses_list(): void
    {
        $storeHouses = StoreHouse::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.store-houses.index'));

        $response->assertOk()->assertSee($storeHouses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_store_house(): void
    {
        $data = StoreHouse::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.store-houses.store'), $data);

        $this->assertDatabaseHas('store_houses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_store_house(): void
    {
        $storeHouse = StoreHouse::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.store-houses.update', $storeHouse),
            $data
        );

        $data['id'] = $storeHouse->id;

        $this->assertDatabaseHas('store_houses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_store_house(): void
    {
        $storeHouse = StoreHouse::factory()->create();

        $response = $this->deleteJson(
            route('api.store-houses.destroy', $storeHouse)
        );

        $this->assertModelMissing($storeHouse);

        $response->assertNoContent();
    }
}
