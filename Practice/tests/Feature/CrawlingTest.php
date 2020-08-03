<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class CrawlingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCrawlingService()
    {
        Log::info('크롤링 테스트 시작!');
        $this ->artisan('command:CrawlingSchedule')
            ->assertExitCode(0);
        Log::info('크롤링 테스트 끝!');
    }

    // public function testSendMailService()
    // {
    //     $this->artisan('command:SendMailSchedule')
    //         ->assertExitCode(0);
    // }
}
