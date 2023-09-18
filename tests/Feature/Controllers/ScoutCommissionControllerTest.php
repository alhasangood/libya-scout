<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ScoutCommission;

use App\Models\Order;
use App\Models\StoreHouse;
use App\Models\ScoutRegiment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoutCommissionControllerTest extends TestCase
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
    public function it_displays_index_view_with_scout_commissions(): void
    {
        $scoutCommissions = ScoutCommission::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('scout-commissions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.scout_commissions.index')
            ->assertViewHas('scoutCommissions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_scout_commission(): void
    {
        $response = $this->get(route('scout-commissions.create'));

        $response->assertOk()->assertViewIs('app.scout_commissions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_scout_commission(): void
    {
        $data = ScoutCommission::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('scout-commissions.store'), $data);

        $this->assertDatabaseHas('scout_commissions', $data);

        $scoutCommission = ScoutCommission::latest('id')->first();

        $response->assertRedirect(
            route('scout-commissions.edit', $scoutCommission)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_scout_commission(): void
    {
        $scoutCommission = ScoutCommission::factory()->create();

        $response = $this->get(
            route('scout-commissions.show', $scoutCommission)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.scout_commissions.show')
            ->assertViewHas('scoutCommission');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_scout_commission(): void
    {
        $scoutCommission = ScoutCommission::factory()->create();

        $response = $this->get(
            route('scout-commissions.edit', $scoutCommission)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.scout_commissions.edit')
            ->assertViewHas('scoutCommission');
    }

    /**
     * @test
     */
    public function it_updates_the_scout_commission(): void
    {
        $scoutCommission = ScoutCommission::factory()->create();

        $storeHouse = StoreHouse::factory()->create();
        $order = Order::factory()->create();
        $user = User::factory()->create();
        $scoutRegiment = ScoutRegiment::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'phone' => $this->faker->randomNumber(),
            'status' => $this->faker->randomNumber(),
            'store_house_id' => $storeHouse->id,
            'order_id' => $order->id,
            'user_id' => $user->id,
            'scout_regiment_id' => $scoutRegiment->id,
        ];

        $response = $this->put(
            route('scout-commissions.update', $scoutCommission),
            $data
        );

        $data['id'] = $scoutCommission->id;

        $this->assertDatabaseHas('scout_commissions', $data);

        $response->assertRedirect(
            route('scout-commissions.edit', $scoutCommission)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_scout_commission(): void
    {
        $scoutCommission = ScoutCommission::factory()->create();

        $response = $this->delete(
            route('scout-commissions.destroy', $scoutCommission)
        );

        $response->assertRedirect(route('scout-commissions.index'));

        $this->assertModelMissing($scoutCommission);
    }
}
