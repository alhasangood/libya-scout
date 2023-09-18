<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\TransprterType;

use App\Models\Transprter;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransprterTypeControllerTest extends TestCase
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
    public function it_displays_index_view_with_transprter_types(): void
    {
        $transprterTypes = TransprterType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('transprter-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.transprter_types.index')
            ->assertViewHas('transprterTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_transprter_type(): void
    {
        $response = $this->get(route('transprter-types.create'));

        $response->assertOk()->assertViewIs('app.transprter_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_transprter_type(): void
    {
        $data = TransprterType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('transprter-types.store'), $data);

        $this->assertDatabaseHas('transprter_types', $data);

        $transprterType = TransprterType::latest('id')->first();

        $response->assertRedirect(
            route('transprter-types.edit', $transprterType)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_transprter_type(): void
    {
        $transprterType = TransprterType::factory()->create();

        $response = $this->get(route('transprter-types.show', $transprterType));

        $response
            ->assertOk()
            ->assertViewIs('app.transprter_types.show')
            ->assertViewHas('transprterType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_transprter_type(): void
    {
        $transprterType = TransprterType::factory()->create();

        $response = $this->get(route('transprter-types.edit', $transprterType));

        $response
            ->assertOk()
            ->assertViewIs('app.transprter_types.edit')
            ->assertViewHas('transprterType');
    }

    /**
     * @test
     */
    public function it_updates_the_transprter_type(): void
    {
        $transprterType = TransprterType::factory()->create();

        $transprter = Transprter::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
            'status' => $this->faker->randomNumber(),
            'transprter_id' => $transprter->id,
        ];

        $response = $this->put(
            route('transprter-types.update', $transprterType),
            $data
        );

        $data['id'] = $transprterType->id;

        $this->assertDatabaseHas('transprter_types', $data);

        $response->assertRedirect(
            route('transprter-types.edit', $transprterType)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_transprter_type(): void
    {
        $transprterType = TransprterType::factory()->create();

        $response = $this->delete(
            route('transprter-types.destroy', $transprterType)
        );

        $response->assertRedirect(route('transprter-types.index'));

        $this->assertModelMissing($transprterType);
    }
}
