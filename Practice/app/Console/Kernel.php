<?php

namespace App\Console;

use App\Console\Commands;
use App\Console\Commands\CrawlingSchedule;
use App\Console\Commands\SendMailSchedule;
use App\Console\Commands\SendReservationSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;


class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */

    protected $commands = [
        CrawlingSchedule::class,
        SendMailSchedule::class,
        SendReservationSchedule::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // 09:00 크롤링 메서드 실행
        $schedule->command('command:CrawlingSchedule')->at(date('H:i'));//at('09:00');

        // 10:00 ~ 24:00 메일발송 스케줄
        $schedule->command('command:SendMailSchedule')->at(date('H:i'));//hourly();

        // 24:00 메일발송시간 변경 스케줄
        $schedule->command('command:SendReservationSchedule')->at('24:00');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
