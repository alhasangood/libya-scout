<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\DonationEntity;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationEntityControllerTest extends TestCase
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
    public function it_displays_index_view_with_donation_entities(): void
    {
        $donationEntities = DonationEntity::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('donation-entities.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.donation_entities.index')
            ->assertViewHas('donationEntities');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_donation_entity(): void
    {
        $response = $this->get(route('donation-entities.create'));

        $response->assertOk()->assertViewIs('app.donation_entities.create');
    }

    /**
     * @test
     */
    public function it_stores_the_donation_entity(): void
    {
        $data = DonationEntity::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('donation-entities.store'), $data);

        $this->assertDatabaseHas('donation_entities', $data);

        $donationEntity = DonationEntity::latest('id')->first();

        $response->assertRedirect(
            route('donation-entities.edit', $donationEntity)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_donation_entity(): void
    {
        $donationEntity = DonationEntity::factory()->create();

        $response = $this->get(
            route('donation-entities.show', $donationEntity)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.donation_entities.show')
            ->assertViewHas('donationEntity');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_donation_entity(): void
    {
        $donationEntity = DonationEntity::factory()->create();

        $response = $this->get(
            route('donation-entities.edit', $donationEntity)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.donation_entities.edit')
            ->assertViewHas('donationEntity');
    }

    /**
     * @test
     */
    public function it_updates_the_donation_entity(): void
    {
        $donationEntity = DonationEntity::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->put(
            route('donation-entities.update', $donationEntity),
            $data
        );

        $data['id'] = $donationEntity->id;

        $this->assertDatabaseHas('donation_entities', $data);

        $response->assertRedirect(
            route('donation-entities.edit', $donationEntity)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_donation_entity(): void
    {
        $donationEntity = DonationEntity::factory()->create();

        $response = $this->delete(
            route('donation-entities.destroy', $donationEntity)
        );

        $response->assertRedirect(route('donation-entities.index'));

        $this->assertModelMissing($donationEntity);
    }
}
