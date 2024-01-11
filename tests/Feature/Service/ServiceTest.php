<?php

namespace tests\Feature\Service;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_service()
    {
        $serviceData = [
            'name' => 'Oil Change',
            'description' => 'Change engine oil and oil filter',
        ];

        $service = Service::create($serviceData);

        $this->assertDatabaseHas('services', $serviceData);
        $this->assertEquals($serviceData['name'], $service->name);
        $this->assertEquals($serviceData['description'], $service->description);
    }

    public function test_can_get_jobs_for_service()
    {
        $service = Service::factory()->create();
        $job1 = $service->jobs()->create(['description' => 'Job 1']);
        $job2 = $service->jobs()->create(['description' => 'Job 2']);

        $this->assertCount(2, $service->jobs);
        $this->assertTrue($service->jobs->contains($job1));
        $this->assertTrue($service->jobs->contains($job2));
    }
    public function test_can_update_service()
    {
        $service = Service::factory()->create();

        $updatedData = [
            'name' => 'Updated Oil Change',
            'description' => 'Updated description',
        ];

        $service->update($updatedData);

        $this->assertDatabaseHas('services', $updatedData);
        $this->assertEquals($updatedData['name'], $service->fresh()->name);
        $this->assertEquals($updatedData['description'], $service->fresh()->description);
    }
}
