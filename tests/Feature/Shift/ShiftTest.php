<?php

namespace Tests\Feature\Shift;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use PhpParser\Node\Expr\Assign;
use Tests\Data\Shift\AssignShiftData;
use Tests\TestCase;

class ShiftTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_assign_shift()
    {
        $response = $this->postJson('/api/v1/shift/assign-shift', (new AssignShiftData())->getAssignShiftData(1), [
            'Accept' => 'application/json'
        ]);

        $response->assertOk();

        $json = json_decode($response->getContent(), true);
        $this->assertSame(true, $json['success']);
    }

    public function test_get_shifts_by_date()
    {
        $response = $this->get('/api/v1/shift/assigned-shifts/worker/1', [
            'Accept' => 'application/json'
        ]);

        $response->assertOk();
        $json = json_decode($response->getContent(), true);
        $this->assertTrue( $json['success']);
        $this->assertGreaterThan(0, $json['data']);
    }
}
