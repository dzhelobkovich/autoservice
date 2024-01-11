<?php

namespace Tests\Feature\Admin\Auth;

use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function registration_page_can_be_rendered()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_register()
    {
        $position = Position::factory()->create();

        $response = $this->post(route('register'), [
            'name' => 'John',
            'surname' => 'Doe',
            'position_id' => $position->id,
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'name' => 'John',
            'surname' => 'Doe',
            'position_id' => $position->id,
            'email' => 'john@example.com',
        ]);

        $this->assertTrue(Hash::check('password123', User::first()->password));
    }

    /** @test */
    public function user_registration_requires_all_fields()
    {
        $response = $this->post(route('register'));

        $response->assertSessionHasErrors(['name', 'surname', 'position_id', 'email', 'password']);
    }

}
