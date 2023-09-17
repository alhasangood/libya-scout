<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Transprter;

use App\Models\TransprterType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransprterControllerTest extends TestCase
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
    public function it_displays_index_view_with_transprters(): void
    {
        $transprters = Transprter::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('transprters.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.transprters.index')
            ->assertViewHas('transprters');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_transprter(): void
    {
        $response = $this->get(route('transprters.create'));

        $response->assertOk()->assertViewIs('app.transprters.create');
    }

    /**
     * @test
     */
    public function it_stores_the_transprter(): void
    {
        $data = Transprter::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('transprters.store'), $data);

        $this->assertDatabaseHas('transprters', $data);

        $transprter = Transprter::latest('id')->first();

        $response->assertRedirect(route('transprters.edit', $transprter));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_transprter(): void
    {
        $transprter = Transprter::factory()->create();

        $response = $this->get(route('transprters.show', $transprter));

        $response
            ->assertOk()
            ->assertViewIs('app.transprters.show')
            ->assertViewHas('transprter');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_transprter(): void
    {
        $transprter = Transprter::factory()->create();

        $response = $this->get(route('transprters.edit', $transprter));

        $response
            ->assertOk()
            ->assertViewIs('app.transprters.edit')
            ->assertViewHas('transprter');
    }

    /**
     * @test
     */
    public function it_updates_the_transprter(): void
    {
        $transprter = Transprter::factory()->create();

        $transprterType = TransprterType::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'identity' => $this->faker->text(255),
            'photo' => $this->faker->word(),
            'address' => $this->faker->text(255),
            'transprter_type_id' => $transprterType->id,
        ];

        $response = $this->put(route('transprters.update', $transprter), $data);

        $data['id'] = $transprter->id;

        $this->assertDatabaseHas('transprters', $data);

        $response->assertRedirect(route('transprters.edit', $transprter));
    }

    /**
     * @test
     */
    public function it_deletes_the_transprter(): void
    {
        $transprter = Transprter::factory()->create();

        $response = $this->delete(route('transprters.destroy', $transprter));

        $response->assertRedirect(route('transprters.index'));

        $this->assertModelMissing($transprter);
    }
}
