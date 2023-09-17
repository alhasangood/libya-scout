<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Roll;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RollUsersTest extends TestCase
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
    public function it_gets_roll_users(): void
    {
        $roll = Roll::factory()->create();
        $users = User::factory()
            ->count(2)
            ->create([
                'roll_id' => $roll->id,
            ]);

        $response = $this->getJson(route('api.rolls.users.index', $roll));

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_roll_users(): void
    {
        $roll = Roll::factory()->create();
        $data = User::factory()
            ->make([
                'roll_id' => $roll->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.rolls.users.store', $roll),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['roll_id']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $user = User::latest('id')->first();

        $this->assertEquals($roll->id, $user->roll_id);
    }
}
