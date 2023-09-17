<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Donation;

use App\Models\Item;
use App\Models\StoreHouse;
use App\Models\DonationDetales;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_donations(): void
    {
        $donations = Donation::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('donations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.donations.index')
            ->assertViewHas('donations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_donation(): void
    {
        $response = $this->get(route('donations.create'));

        $response->assertOk()->assertViewIs('app.donations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_donation(): void
    {
        $data = Donation::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('donations.store'), $data);

        unset($data['qtuantity']);
        unset($data['item_id']);
        unset($data['store_house_id']);

        $this->assertDatabaseHas('donations', $data);

        $donation = Donation::latest('id')->first();

        $response->assertRedirect(route('donations.edit', $donation));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_donation(): void
    {
        $donation = Donation::factory()->create();

        $response = $this->get(route('donations.show', $donation));

        $response
            ->assertOk()
            ->assertViewIs('app.donations.show')
            ->assertViewHas('donation');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_donation(): void
    {
        $donation = Donation::factory()->create();

        $response = $this->get(route('donations.edit', $donation));

        $response
            ->assertOk()
            ->assertViewIs('app.donations.edit')
            ->assertViewHas('donation');
    }

    /**
     * @test
     */
    public function it_updates_the_donation(): void
    {
        $donation = Donation::factory()->create();

        $donationDetales = DonationDetales::factory()->create();
        $item = Item::factory()->create();
        $storeHouse = StoreHouse::factory()->create();

        $data = [
            'description' => $this->faker->name(),
            'qtuantity' => $this->faker->randomNumber(),
            'donation_detales_id' => $donationDetales->id,
            'item_id' => $item->id,
            'store_house_id' => $storeHouse->id,
        ];

        $response = $this->put(route('donations.update', $donation), $data);

        unset($data['qtuantity']);
        unset($data['item_id']);
        unset($data['store_house_id']);

        $data['id'] = $donation->id;

        $this->assertDatabaseHas('donations', $data);

        $response->assertRedirect(route('donations.edit', $donation));
    }

    /**
     * @test
     */
    public function it_deletes_the_donation(): void
    {
        $donation = Donation::factory()->create();

        $response = $this->delete(route('donations.destroy', $donation));

        $response->assertRedirect(route('donations.index'));

        $this->assertModelMissing($donation);
    }
}
