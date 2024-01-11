<?php

namespace Tests\Feature\Models;

use App\Models\Rebuke;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RebukeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_soft_deleted()
    {
        $rebuke = Rebuke::factory()->create();

        $rebuke->delete();

        $this->assertSoftDeleted('rebukes', ['id' => $rebuke->id]);
    }

}
