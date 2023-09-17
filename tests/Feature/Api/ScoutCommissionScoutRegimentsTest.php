<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ScoutRegiment;
use App\Models\ScoutCommission;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoutCommissionScoutRegimentsTest extends TestCase
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
    public function it_gets_scout_commission_scout_regiments(): void
    {
        $scoutCommission = ScoutCommission::factory()->create();
        $scoutRegiments = ScoutRegiment::factory()
            ->count(2)
            ->create([
                'scout_commission_id' => $scoutCommission->id,
            ]);

        $response = $this->getJson(
            route(
                'api.scout-commissions.scout-regiments.index',
                $scoutCommission
            )
        );

        $response->assertOk()->assertSee($scoutRegiments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_scout_commission_scout_regiments(): void
    {
        $scoutCommission = ScoutCommission::factory()->create();
        $data = ScoutRegiment::factory()
            ->make([
                'scout_commission_id' => $scoutCommission->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.scout-commissions.scout-regiments.store',
                $scoutCommission
            ),
            $data
        );

        unset($data['scout_regimentable_id']);
        unset($data['scout_regimentable_type']);

        $this->assertDatabaseHas('scout_regiments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $scoutRegiment = ScoutRegiment::latest('id')->first();

        $this->assertEquals(
            $scoutCommission->id,
            $scoutRegiment->scout_commission_id
        );
    }
}
