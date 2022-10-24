<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class CheckTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_check()
    {
        $response = $this->get('/api/v1/check');

        $response->assertOk();
    }
}
