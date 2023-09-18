<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\DonationEntity;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationEntityTest extends TestCase
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
    public function it_gets_donation_entities_list(): void
    {
        $donationEntities = DonationEntity::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.donation-entities.index'));

        $response->assertOk()->assertSee($donationEntities[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_donation_entity(): void
    {
        $data = DonationEntity::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.donation-entities.store'),
            $data
        );

        $this->assertDatabaseHas('donation_entities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_donation_entity(): void
    {
        $donationEntity = DonationEntity::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'status' => $this->faker->randomNumber(),
        ];

        $response = $this->putJson(
            route('api.donation-entities.update', $donationEntity),
            $data
        );

        $data['id'] = $donationEntity->id;

        $this->assertDatabaseHas('donation_entities', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_donation_entity(): void
    {
        $donationEntity = DonationEntity::factory()->create();

        $response = $this->deleteJson(
            route('api.donation-entities.destroy', $donationEntity)
        );

        $this->assertModelMissing($donationEntity);

        $response->assertNoContent();
    }
}
