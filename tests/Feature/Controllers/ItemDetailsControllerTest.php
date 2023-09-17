<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ItemDetails;

use App\Models\Item;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemDetailsControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_item_details(): void
    {
        $allItemDetails = ItemDetails::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-item-details.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_item_details.index')
            ->assertViewHas('allItemDetails');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_item_details(): void
    {
        $response = $this->get(route('all-item-details.create'));

        $response->assertOk()->assertViewIs('app.all_item_details.create');
    }

    /**
     * @test
     */
    public function it_stores_the_item_details(): void
    {
        $data = ItemDetails::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-item-details.store'), $data);

        $this->assertDatabaseHas('item_details', $data);

        $itemDetails = ItemDetails::latest('id')->first();

        $response->assertRedirect(route('all-item-details.edit', $itemDetails));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_item_details(): void
    {
        $itemDetails = ItemDetails::factory()->create();

        $response = $this->get(route('all-item-details.show', $itemDetails));

        $response
            ->assertOk()
            ->assertViewIs('app.all_item_details.show')
            ->assertViewHas('itemDetails');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_item_details(): void
    {
        $itemDetails = ItemDetails::factory()->create();

        $response = $this->get(route('all-item-details.edit', $itemDetails));

        $response
            ->assertOk()
            ->assertViewIs('app.all_item_details.edit')
            ->assertViewHas('itemDetails');
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

        $response = $this->put(
            route('all-item-details.update', $itemDetails),
            $data
        );

        $data['id'] = $itemDetails->id;

        $this->assertDatabaseHas('item_details', $data);

        $response->assertRedirect(route('all-item-details.edit', $itemDetails));
    }

    /**
     * @test
     */
    public function it_deletes_the_item_details(): void
    {
        $itemDetails = ItemDetails::factory()->create();

        $response = $this->delete(
            route('all-item-details.destroy', $itemDetails)
        );

        $response->assertRedirect(route('all-item-details.index'));

        $this->assertModelMissing($itemDetails);
    }
}
