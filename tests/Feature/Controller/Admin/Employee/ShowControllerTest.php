<?php

namespace Tests\Feature\Admin\Employee;

use App\Models\Job;
use App\Models\Position;
use App\Models\Service;
use App\Models\Rebuke;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_page_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->get(route('admin.employee.show', $user));

        $response->assertStatus(200);
        $response->assertViewIs('admin.employee.show');
        $response->assertViewHas('employee', $user);
    }

    /** @test */
    public function show_page_displays_correct_month_names()
    {
        $user = User::factory()->create();

        $response = $this->get(route('admin.employee.show', $user));

        $response->assertSeeInOrder(['Янв.', 'Фев.', 'Мар.', 'Апр.', 'Май', 'Июн.', 'Июл.', 'Авг.', 'Сен.', 'Окт.', 'Ноя.', 'Дек.']);
    }
}
