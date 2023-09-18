<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Donation;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationCategoriesTest extends TestCase
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
    public function it_gets_donation_categories(): void
    {
        $donation = Donation::factory()->create();
        $categories = Category::factory()
            ->count(2)
            ->create([
                'donation_id' => $donation->id,
            ]);

        $response = $this->getJson(
            route('api.donations.categories.index', $donation)
        );

        $response->assertOk()->assertSee($categories[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_donation_categories(): void
    {
        $donation = Donation::factory()->create();
        $data = Category::factory()
            ->make([
                'donation_id' => $donation->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.donations.categories.store', $donation),
            $data
        );

        $this->assertDatabaseHas('categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $category = Category::latest('id')->first();

        $this->assertEquals($donation->id, $category->donation_id);
    }
}
