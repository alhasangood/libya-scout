<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Donation;
use App\Models\DonationDetales;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationDetalesDonationsTest extends TestCase
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
    public function it_gets_donation_detales_donations(): void
    {
        $donationDetales = DonationDetales::factory()->create();
        $donations = Donation::factory()
            ->count(2)
            ->create([
                'donation_detales_id' => $donationDetales->id,
            ]);

        $response = $this->getJson(
            route('api.all-donation-detales.donations.index', $donationDetales)
        );

        $response->assertOk()->assertSee($donations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_donation_detales_donations(): void
    {
        $donationDetales = DonationDetales::factory()->create();
        $data = Donation::factory()
            ->make([
                'donation_detales_id' => $donationDetales->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.all-donation-detales.donations.store', $donationDetales),
            $data
        );

        $this->assertDatabaseHas('donations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $donation = Donation::latest('id')->first();

        $this->assertEquals(
            $donationDetales->id,
            $donation->donation_detales_id
        );
    }
}
