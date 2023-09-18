<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Transprter;
use App\Models\TransprterType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransprterTransprterTypesTest extends TestCase
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
    public function it_gets_transprter_transprter_types(): void
    {
        $transprter = Transprter::factory()->create();
        $transprterTypes = TransprterType::factory()
            ->count(2)
            ->create([
                'transprter_id' => $transprter->id,
            ]);

        $response = $this->getJson(
            route('api.transprters.transprter-types.index', $transprter)
        );

        $response->assertOk()->assertSee($transprterTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_transprter_transprter_types(): void
    {
        $transprter = Transprter::factory()->create();
        $data = TransprterType::factory()
            ->make([
                'transprter_id' => $transprter->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.transprters.transprter-types.store', $transprter),
            $data
        );

        $this->assertDatabaseHas('transprter_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $transprterType = TransprterType::latest('id')->first();

        $this->assertEquals($transprter->id, $transprterType->transprter_id);
    }
}
