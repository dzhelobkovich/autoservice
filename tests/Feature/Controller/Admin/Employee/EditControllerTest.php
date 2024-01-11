<?php

namespace tests\Feature\Controller\Admin\Employee;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function edit_page_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->get(route('admin.employee.edit', $user));

        $response->assertStatus(200);
        $response->assertViewIs('admin.employee.edit');
        $response->assertViewHas('positions');
        $response->assertViewHas('employee', $user);
    }

}
