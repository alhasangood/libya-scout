<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\TransprterType;

use App\Models\Transprter;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransprterTypeTest extends TestCase
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
    public function it_gets_transprter_types_list(): void
    {
        $transprterTypes = TransprterType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.transprter-types.index'));

        $response->assertOk()->assertSee($transprterTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_transprter_type(): void
    {
        $data = TransprterType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.transprter-types.store'), $data);

        $this->assertDatabaseHas('transprter_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_transprter_type(): void
    {
        $transprterType = TransprterType::factory()->create();

        $transprter = Transprter::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
            'status' => $this->faker->randomNumber(),
            'transprter_id' => $transprter->id,
        ];

        $response = $this->putJson(
            route('api.transprter-types.update', $transprterType),
            $data
        );

        $data['id'] = $transprterType->id;

        $this->assertDatabaseHas('transprter_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_transprter_type(): void
    {
        $transprterType = TransprterType::factory()->create();

        $response = $this->deleteJson(
            route('api.transprter-types.destroy', $transprterType)
        );

        $this->assertModelMissing($transprterType);

        $response->assertNoContent();
    }
}
