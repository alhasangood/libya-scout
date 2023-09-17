<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ScoutCommission;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoutCommissionTest extends TestCase
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
    public function it_gets_scout_commissions_list(): void
    {
        $scoutCommissions = ScoutCommission::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.scout-commissions.index'));

        $response->assertOk()->assertSee($scoutCommissions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_scout_commission(): void
    {
        $data = ScoutCommission::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.scout-commissions.store'),
            $data
        );

        unset($data['scout_commissionable_id']);
        unset($data['scout_commissionable_type']);

        $this->assertDatabaseHas('scout_commissions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.scout-commissions.update', $scoutCommission),
            $data
        );

        unset($data['scout_commissionable_id']);
        unset($data['scout_commissionable_type']);

        $data['id'] = $scoutCommission->id;

        $this->assertDatabaseHas('scout_commissions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_scout_commission(): void
    {
        $scoutCommission = ScoutCommission::factory()->create();

        $response = $this->deleteJson(
            route('api.scout-commissions.destroy', $scoutCommission)
        );

        $this->assertModelMissing($scoutCommission);

        $response->assertNoContent();
    }
}
