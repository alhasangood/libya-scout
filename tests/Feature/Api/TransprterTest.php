<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Transprter;

use App\Models\TransprterType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransprterTest extends TestCase
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
    public function it_gets_transprters_list(): void
    {
        $transprters = Transprter::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.transprters.index'));

        $response->assertOk()->assertSee($transprters[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_transprter(): void
    {
        $data = Transprter::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.transprters.store'), $data);

        $this->assertDatabaseHas('transprters', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_transprter(): void
    {
        $transprter = Transprter::factory()->create();

        $transprterType = TransprterType::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'identity' => $this->faker->text(255),
            'photo' => $this->faker->word(),
            'address' => $this->faker->text(255),
            'transprter_type_id' => $transprterType->id,
        ];

        $response = $this->putJson(
            route('api.transprters.update', $transprter),
            $data
        );

        $data['id'] = $transprter->id;

        $this->assertDatabaseHas('transprters', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_transprter(): void
    {
        $transprter = Transprter::factory()->create();

        $response = $this->deleteJson(
            route('api.transprters.destroy', $transprter)
        );

        $this->assertModelMissing($transprter);

        $response->assertNoContent();
    }
}
