<?php

namespace Tests\Feature\Models;

use App\Models\Service;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_jobs_relationship()
    {
        $service = Service::factory()->create();
        $job = Job::factory()->create(['service_id' => $service->id]);

        $this->assertTrue($service->jobs->contains($job));
    }
}
