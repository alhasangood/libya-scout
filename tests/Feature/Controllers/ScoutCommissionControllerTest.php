<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ScoutCommission;

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

        unset($data['scout_commissionable_id']);
        unset($data['scout_commissionable_type']);

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

        $data = [
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->randomNumber(),
        ];

        $response = $this->put(
            route('scout-commissions.update', $scoutCommission),
            $data
        );

        unset($data['scout_commissionable_id']);
        unset($data['scout_commissionable_type']);

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
