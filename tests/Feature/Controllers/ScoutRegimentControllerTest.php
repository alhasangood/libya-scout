<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ScoutRegiment;

use App\Models\Order;
use App\Models\StoreHouse;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoutRegimentControllerTest extends TestCase
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
    public function it_displays_index_view_with_scout_regiments(): void
    {
        $scoutRegiments = ScoutRegiment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('scout-regiments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.scout_regiments.index')
            ->assertViewHas('scoutRegiments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_scout_regiment(): void
    {
        $response = $this->get(route('scout-regiments.create'));

        $response->assertOk()->assertViewIs('app.scout_regiments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_scout_regiment(): void
    {
        $data = ScoutRegiment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('scout-regiments.store'), $data);

        $this->assertDatabaseHas('scout_regiments', $data);

        $scoutRegiment = ScoutRegiment::latest('id')->first();

        $response->assertRedirect(
            route('scout-regiments.edit', $scoutRegiment)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_scout_regiment(): void
    {
        $scoutRegiment = ScoutRegiment::factory()->create();

        $response = $this->get(route('scout-regiments.show', $scoutRegiment));

        $response
            ->assertOk()
            ->assertViewIs('app.scout_regiments.show')
            ->assertViewHas('scoutRegiment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_scout_regiment(): void
    {
        $scoutRegiment = ScoutRegiment::factory()->create();

        $response = $this->get(route('scout-regiments.edit', $scoutRegiment));

        $response
            ->assertOk()
            ->assertViewIs('app.scout_regiments.edit')
            ->assertViewHas('scoutRegiment');
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

        $response = $this->put(
            route('scout-regiments.update', $scoutRegiment),
            $data
        );

        $data['id'] = $scoutRegiment->id;

        $this->assertDatabaseHas('scout_regiments', $data);

        $response->assertRedirect(
            route('scout-regiments.edit', $scoutRegiment)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_scout_regiment(): void
    {
        $scoutRegiment = ScoutRegiment::factory()->create();

        $response = $this->delete(
            route('scout-regiments.destroy', $scoutRegiment)
        );

        $response->assertRedirect(route('scout-regiments.index'));

        $this->assertModelMissing($scoutRegiment);
    }
}
