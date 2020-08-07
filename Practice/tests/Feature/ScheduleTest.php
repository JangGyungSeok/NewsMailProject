<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // public function testDatabase()
    // {
    //     $receiverFactory = factory(\App\Receiver::class, function ($faker){
    //         return [
    //             'email'=>$faker->unique()->safeEmail,
    //             'name' =>$faker->name
    //         ];
    //     });

    //     $receiverFactory->create()->save();

    // }

    public function testCrawlingSchedule()
    {
        Log::info('크롤링 테스트 시작!');
        $this ->artisan('command:CrawlingSchedule')
            ->assertExitCode(0);
        Log::info('크롤링 테스트 끝!');
    }

    public function testSendMailSchedule()
    {
        Log::info('메일발송 테스트 시작');
        $this->artisan('command:SendMailSchedule')
            ->assertExitCode(0);
        Log::info('메일발송 테스트 끝');
    }

    // public function testSendReservationSchedule()
    // {
    //     Log::info('메일발송시간 변경 테스트 시작');
    //     $this->artisan('command:SendReservationSchedule')
    //         ->assertExitCode(0);
    //     Log::info('메일발송시간 변경 테스트 끝');
    // }


    // public function testClearDb()
    // {
    //     DB::table('news_data')->delete();
    //     DB::table('receive_time_logs')->delete();
    //     DB::table('mail_send_logs')->delete();
    // }
}
