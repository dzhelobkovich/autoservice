<?php

namespace Tests\Feature\Admin\Employee;

use App\Http\Requests\Employee\UpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function employee_can_be_updated()
    {
        $user = User::factory()->create();
        $updatedData = [
            // Add updated data here
            'name' => 'Updated Name',
            'surname' => 'Updated Surname',
            'position_id' => 2,
        ];

        $response = $this->put(route('admin.employee.update', $user), $updatedData);

        $response->assertRedirect(route('admin.employee.show', $user));
        $this->assertDatabaseHas('users', array_merge(['id' => $user->id], $updatedData));
    }

    /** @test */
    public function update_request_validation_rules_are_enforced()
    {
        $user = User::factory()->create();
        $invalidData = [
            'name' => '',
        ];

        $response = $this->put(route('admin.employee.update', $user), $invalidData);

        $response->assertSessionHasErrors(['name']);
    }

}
