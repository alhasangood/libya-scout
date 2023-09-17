<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ItemDetails;

use App\Models\Item;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemDetailsTest extends TestCase
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
    public function it_gets_all_item_details_list(): void
    {
        $allItemDetails = ItemDetails::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-item-details.index'));

        $response->assertOk()->assertSee($allItemDetails[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_item_details(): void
    {
        $data = ItemDetails::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-item-details.store'), $data);

        $this->assertDatabaseHas('item_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_item_details(): void
    {
        $itemDetails = ItemDetails::factory()->create();

        $item = Item::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'unit' => $this->faker->text(255),
            'qtuantity' => $this->faker->randomNumber(),
            'item_id' => $item->id,
        ];

        $response = $this->putJson(
            route('api.all-item-details.update', $itemDetails),
            $data
        );

        $data['id'] = $itemDetails->id;

        $this->assertDatabaseHas('item_details', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_item_details(): void
    {
        $itemDetails = ItemDetails::factory()->create();

        $response = $this->deleteJson(
            route('api.all-item-details.destroy', $itemDetails)
        );

        $this->assertModelMissing($itemDetails);

        $response->assertNoContent();
    }
}
