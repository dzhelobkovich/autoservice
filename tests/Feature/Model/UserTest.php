<?php

namespace tests\Feature\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// Импортируем Factory

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user()
    {
        $user = Factory::factoryForModel(User::class)->create([
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john.doe@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john.doe@example.com',
        ]);
    }

    public function test_can_retrieve_user()
    {
        $user = Factory::factoryForModel(User::class)->create();

        $response = $this->get("/users/{$user->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
            ]);
    }

    public function test_can_update_user()
    {
        $user = Factory::factoryForModel(User::class)->create();

        $response = $this->put("/users/{$user->id}", [
            'name' => 'Updated Name',
            'surname' => 'Updated Surname',
            'email' => 'updated.email@example.com',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'surname' => 'Updated Surname',
            'email' => 'updated.email@example.com',
        ]);
    }
}
