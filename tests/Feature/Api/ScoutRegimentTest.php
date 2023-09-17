<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ScoutRegiment;

use App\Models\ScoutCommission;

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

        unset($data['scout_regimentable_id']);
        unset($data['scout_regimentable_type']);
        unset($data['scout_commission_id']);

        $this->assertDatabaseHas('scout_regiments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_scout_regiment(): void
    {
        $scoutRegiment = ScoutRegiment::factory()->create();

        $scoutCommission = ScoutCommission::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->randomNumber(),
            'scout_commission_id' => $scoutCommission->id,
        ];

        $response = $this->putJson(
            route('api.scout-regiments.update', $scoutRegiment),
            $data
        );

        unset($data['scout_regimentable_id']);
        unset($data['scout_regimentable_type']);
        unset($data['scout_commission_id']);

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
