<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Transprter;
use App\Models\TransprterType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransprterTypeTransprtersTest extends TestCase
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
    public function it_gets_transprter_type_transprters(): void
    {
        $transprterType = TransprterType::factory()->create();
        $transprters = Transprter::factory()
            ->count(2)
            ->create([
                'transprter_type_id' => $transprterType->id,
            ]);

        $response = $this->getJson(
            route('api.transprter-types.transprters.index', $transprterType)
        );

        $response->assertOk()->assertSee($transprters[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_transprter_type_transprters(): void
    {
        $transprterType = TransprterType::factory()->create();
        $data = Transprter::factory()
            ->make([
                'transprter_type_id' => $transprterType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.transprter-types.transprters.store', $transprterType),
            $data
        );

        $this->assertDatabaseHas('transprters', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $transprter = Transprter::latest('id')->first();

        $this->assertEquals(
            $transprterType->id,
            $transprter->transprter_type_id
        );
    }
}
