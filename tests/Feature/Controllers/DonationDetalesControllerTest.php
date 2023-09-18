<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\DonationDetales;

use App\Models\DonationEntity;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationDetalesControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_donation_detales(): void
    {
        $allDonationDetales = DonationDetales::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-donation-detales.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_donation_detales.index')
            ->assertViewHas('allDonationDetales');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_donation_detales(): void
    {
        $response = $this->get(route('all-donation-detales.create'));

        $response->assertOk()->assertViewIs('app.all_donation_detales.create');
    }

    /**
     * @test
     */
    public function it_stores_the_donation_detales(): void
    {
        $data = DonationDetales::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-donation-detales.store'), $data);

        $this->assertDatabaseHas('donation_detales', $data);

        $donationDetales = DonationDetales::latest('id')->first();

        $response->assertRedirect(
            route('all-donation-detales.edit', $donationDetales)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_donation_detales(): void
    {
        $donationDetales = DonationDetales::factory()->create();

        $response = $this->get(
            route('all-donation-detales.show', $donationDetales)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.all_donation_detales.show')
            ->assertViewHas('donationDetales');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_donation_detales(): void
    {
        $donationDetales = DonationDetales::factory()->create();

        $response = $this->get(
            route('all-donation-detales.edit', $donationDetales)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.all_donation_detales.edit')
            ->assertViewHas('donationDetales');
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

        $response = $this->put(
            route('all-donation-detales.update', $donationDetales),
            $data
        );

        $data['id'] = $donationDetales->id;

        $this->assertDatabaseHas('donation_detales', $data);

        $response->assertRedirect(
            route('all-donation-detales.edit', $donationDetales)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_donation_detales(): void
    {
        $donationDetales = DonationDetales::factory()->create();

        $response = $this->delete(
            route('all-donation-detales.destroy', $donationDetales)
        );

        $response->assertRedirect(route('all-donation-detales.index'));

        $this->assertModelMissing($donationDetales);
    }
}
