<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\DonationEntity;
use App\Models\DonationDetales;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationEntityAllDonationDetalesTest extends TestCase
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
    public function it_gets_donation_entity_all_donation_detales(): void
    {
        $donationEntity = DonationEntity::factory()->create();
        $allDonationDetales = DonationDetales::factory()
            ->count(2)
            ->create([
                'donation_entity_id' => $donationEntity->id,
            ]);

        $response = $this->getJson(
            route(
                'api.donation-entities.all-donation-detales.index',
                $donationEntity
            )
        );

        $response->assertOk()->assertSee($allDonationDetales[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_donation_entity_all_donation_detales(): void
    {
        $donationEntity = DonationEntity::factory()->create();
        $data = DonationDetales::factory()
            ->make([
                'donation_entity_id' => $donationEntity->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.donation-entities.all-donation-detales.store',
                $donationEntity
            ),
            $data
        );

        $this->assertDatabaseHas('donation_detales', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $donationDetales = DonationDetales::latest('id')->first();

        $this->assertEquals(
            $donationEntity->id,
            $donationDetales->donation_entity_id
        );
    }
}
