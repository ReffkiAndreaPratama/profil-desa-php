<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_verification_notice_page_is_accessible(): void
    {
        $response = $this->get(route('verification.notice'));

        $response->assertStatus(200);
    }
}
