<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Donation;

use App\Models\Order;
use App\Models\DonationDetales;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationTest extends TestCase
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
    public function it_gets_donations_list(): void
    {
        $donations = Donation::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.donations.index'));

        $response->assertOk()->assertSee($donations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_donation(): void
    {
        $data = Donation::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.donations.store'), $data);

        $this->assertDatabaseHas('donations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_donation(): void
    {
        $donation = Donation::factory()->create();

        $donationDetales = DonationDetales::factory()->create();
        $order = Order::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'status' => $this->faker->randomNumber(),
            'donation_detales_id' => $donationDetales->id,
            'order_id' => $order->id,
        ];

        $response = $this->putJson(
            route('api.donations.update', $donation),
            $data
        );

        $data['id'] = $donation->id;

        $this->assertDatabaseHas('donations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_donation(): void
    {
        $donation = Donation::factory()->create();

        $response = $this->deleteJson(
            route('api.donations.destroy', $donation)
        );

        $this->assertModelMissing($donation);

        $response->assertNoContent();
    }
}
