<?php

namespace tests\Feature\Controller\Admin\Employee;

use App\Models\Job;
use App\Models\Position;
use App\Models\Rebuke;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UserProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_profile_view()
    {
        $user = User::create([
            'name' => 'TestName',
            'surname' => 'TestSurname',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);

        $position = Position::create(['title' => 'TestPosition']);
        $service = Service::create(['title' => 'TestService']);
        $job = Job::create(['user_id' => $user->id, 'work_time' => 8]);
        $rebuke = Rebuke::create(['user_id' => $user->id, 'reason' => 'TestReason']);

        $this->actingAs($user);

        $response = $this->get(route('user.profile'));

        $response->assertStatus(200);

        $response->assertSeeText($user->name)
            ->assertSeeText($user->surname)
            ->assertSeeText($position->title)
            ->assertSeeText($service->title)
            ->assertSeeText($job->work_time)
            ->assertSeeText($rebuke->reason);

    }
}
