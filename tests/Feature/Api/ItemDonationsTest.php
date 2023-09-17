<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\Donation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemDonationsTest extends TestCase
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
    public function it_gets_item_donations(): void
    {
        $item = Item::factory()->create();
        $donations = Donation::factory()
            ->count(2)
            ->create([
                'item_id' => $item->id,
            ]);

        $response = $this->getJson(route('api.items.donations.index', $item));

        $response->assertOk()->assertSee($donations[0]->description);
    }

    /**
     * @test
     */
    public function it_stores_the_item_donations(): void
    {
        $item = Item::factory()->create();
        $data = Donation::factory()
            ->make([
                'item_id' => $item->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.items.donations.store', $item),
            $data
        );

        unset($data['qtuantity']);
        unset($data['item_id']);
        unset($data['store_house_id']);

        $this->assertDatabaseHas('donations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $donation = Donation::latest('id')->first();

        $this->assertEquals($item->id, $donation->item_id);
    }
}
