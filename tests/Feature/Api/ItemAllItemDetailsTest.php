<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\ItemDetails;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemAllItemDetailsTest extends TestCase
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
    public function it_gets_item_all_item_details(): void
    {
        $item = Item::factory()->create();
        $allItemDetails = ItemDetails::factory()
            ->count(2)
            ->create([
                'item_id' => $item->id,
            ]);

        $response = $this->getJson(
            route('api.items.all-item-details.index', $item)
        );

        $response->assertOk()->assertSee($allItemDetails[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_item_all_item_details(): void
    {
        $item = Item::factory()->create();
        $data = ItemDetails::factory()
            ->make([
                'item_id' => $item->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.items.all-item-details.store', $item),
            $data
        );

        $this->assertDatabaseHas('item_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $itemDetails = ItemDetails::latest('id')->first();

        $this->assertEquals($item->id, $itemDetails->item_id);
    }
}
