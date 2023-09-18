<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemCategoriesTest extends TestCase
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
    public function it_gets_item_categories(): void
    {
        $item = Item::factory()->create();
        $categories = Category::factory()
            ->count(2)
            ->create([
                'item_id' => $item->id,
            ]);

        $response = $this->getJson(route('api.items.categories.index', $item));

        $response->assertOk()->assertSee($categories[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_item_categories(): void
    {
        $item = Item::factory()->create();
        $data = Category::factory()
            ->make([
                'item_id' => $item->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.items.categories.store', $item),
            $data
        );

        $this->assertDatabaseHas('categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $category = Category::latest('id')->first();

        $this->assertEquals($item->id, $category->item_id);
    }
}
