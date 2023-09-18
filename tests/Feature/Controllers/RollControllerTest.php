<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Roll;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RollControllerTest extends TestCase
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
    public function it_displays_index_view_with_rolls(): void
    {
        $rolls = Roll::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('rolls.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.rolls.index')
            ->assertViewHas('rolls');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_roll(): void
    {
        $response = $this->get(route('rolls.create'));

        $response->assertOk()->assertViewIs('app.rolls.create');
    }

    /**
     * @test
     */
    public function it_stores_the_roll(): void
    {
        $data = Roll::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('rolls.store'), $data);

        $this->assertDatabaseHas('rolls', $data);

        $roll = Roll::latest('id')->first();

        $response->assertRedirect(route('rolls.edit', $roll));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_roll(): void
    {
        $roll = Roll::factory()->create();

        $response = $this->get(route('rolls.show', $roll));

        $response
            ->assertOk()
            ->assertViewIs('app.rolls.show')
            ->assertViewHas('roll');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_roll(): void
    {
        $roll = Roll::factory()->create();

        $response = $this->get(route('rolls.edit', $roll));

        $response
            ->assertOk()
            ->assertViewIs('app.rolls.edit')
            ->assertViewHas('roll');
    }

    /**
     * @test
     */
    public function it_updates_the_roll(): void
    {
        $roll = Roll::factory()->create();

        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->put(route('rolls.update', $roll), $data);

        $data['id'] = $roll->id;

        $this->assertDatabaseHas('rolls', $data);

        $response->assertRedirect(route('rolls.edit', $roll));
    }

    /**
     * @test
     */
    public function it_deletes_the_roll(): void
    {
        $roll = Roll::factory()->create();

        $response = $this->delete(route('rolls.destroy', $roll));

        $response->assertRedirect(route('rolls.index'));

        $this->assertModelMissing($roll);
    }
}
