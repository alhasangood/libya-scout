<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\DonationDetales;

use App\Models\DonationEntity;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationDetalesTest extends TestCase
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
    public function it_gets_all_donation_detales_list(): void
    {
        $allDonationDetales = DonationDetales::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-donation-detales.index'));

        $response->assertOk()->assertSee($allDonationDetales[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_donation_detales(): void
    {
        $data = DonationDetales::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.all-donation-detales.store'),
            $data
        );

        $this->assertDatabaseHas('donation_detales', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_donation_detales(): void
    {
        $donationDetales = DonationDetales::factory()->create();

        $donationEntity = DonationEntity::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'person' => $this->faker->text(255),
            'logo' => $this->faker->word(),
            'number' => $this->faker->randomNumber(),
            'donation_entity_id' => $donationEntity->id,
        ];

        $response = $this->putJson(
            route('api.all-donation-detales.update', $donationDetales),
            $data
        );

        $data['id'] = $donationDetales->id;

        $this->assertDatabaseHas('donation_detales', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_donation_detales(): void
    {
        $donationDetales = DonationDetales::factory()->create();

        $response = $this->deleteJson(
            route('api.all-donation-detales.destroy', $donationDetales)
        );

        $this->assertModelMissing($donationDetales);

        $response->assertNoContent();
    }
}
