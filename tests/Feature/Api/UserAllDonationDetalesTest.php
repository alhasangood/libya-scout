<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\DonationDetales;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAllDonationDetalesTest extends TestCase
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
    public function it_gets_user_all_donation_detales(): void
    {
        $user = User::factory()->create();
        $allDonationDetales = DonationDetales::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.all-donation-detales.index', $user)
        );

        $response->assertOk()->assertSee($allDonationDetales[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_all_donation_detales(): void
    {
        $user = User::factory()->create();
        $data = DonationDetales::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.all-donation-detales.store', $user),
            $data
        );

        unset($data['user_id']);

        $this->assertDatabaseHas('donation_detales', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $donationDetales = DonationDetales::latest('id')->first();

        $this->assertEquals($user->id, $donationDetales->user_id);
    }
}
