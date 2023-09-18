<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Roll;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RollTest extends TestCase
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
    public function it_gets_rolls_list(): void
    {
        $rolls = Roll::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.rolls.index'));

        $response->assertOk()->assertSee($rolls[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_roll(): void
    {
        $data = Roll::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.rolls.store'), $data);

        $this->assertDatabaseHas('rolls', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_roll(): void
    {
        $roll = Roll::factory()->create();

        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(route('api.rolls.update', $roll), $data);

        $data['id'] = $roll->id;

        $this->assertDatabaseHas('rolls', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_roll(): void
    {
        $roll = Roll::factory()->create();

        $response = $this->deleteJson(route('api.rolls.destroy', $roll));

        $this->assertModelMissing($roll);

        $response->assertNoContent();
    }
}
