<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\StoreHouse;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreHouseControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_store_houses(): void
    {
        $storeHouses = StoreHouse::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('store-houses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.store_houses.index')
            ->assertViewHas('storeHouses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_store_house(): void
    {
        $response = $this->get(route('store-houses.create'));

        $response->assertOk()->assertViewIs('app.store_houses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_store_house(): void
    {
        $data = StoreHouse::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('store-houses.store'), $data);

        $this->assertDatabaseHas('store_houses', $data);

        $storeHouse = StoreHouse::latest('id')->first();

        $response->assertRedirect(route('store-houses.edit', $storeHouse));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_store_house(): void
    {
        $storeHouse = StoreHouse::factory()->create();

        $response = $this->get(route('store-houses.show', $storeHouse));

        $response
            ->assertOk()
            ->assertViewIs('app.store_houses.show')
            ->assertViewHas('storeHouse');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_store_house(): void
    {
        $storeHouse = StoreHouse::factory()->create();

        $response = $this->get(route('store-houses.edit', $storeHouse));

        $response
            ->assertOk()
            ->assertViewIs('app.store_houses.edit')
            ->assertViewHas('storeHouse');
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

        $response = $this->put(
            route('store-houses.update', $storeHouse),
            $data
        );

        $data['id'] = $storeHouse->id;

        $this->assertDatabaseHas('store_houses', $data);

        $response->assertRedirect(route('store-houses.edit', $storeHouse));
    }

    /**
     * @test
     */
    public function it_deletes_the_store_house(): void
    {
        $storeHouse = StoreHouse::factory()->create();

        $response = $this->delete(route('store-houses.destroy', $storeHouse));

        $response->assertRedirect(route('store-houses.index'));

        $this->assertModelMissing($storeHouse);
    }
}
