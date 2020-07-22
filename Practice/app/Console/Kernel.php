<?php

namespace App\Console;

use \App\Receiver;
use \App\Console\Commands;
use App\Console\Commands\CrawlingSchedule;
use App\Console\Commands\SendMailSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
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
        SendMailSchedule::class
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
        // $schedule->command('command:CrawlingSchedule')->at(date('H:i'));//at('09:00');

        // 최신 방법 시작
        // DB 값을 참조 (메일 스케줄 시간 및 수신자 정보)
        $userData = DB::table('Receivers')->select('*')->get();
        // dump($userData);
        for($i=0; $i<sizeof($userData);$i++){
            // 수신자별 메일수신 선호시간에 맞춰 스케줄링
            $schedule
                ->command(
                    'command:SendMailSchedule'
                    ,[
                        $userData[$i]->idx
                        ,$userData[$i]->email
                        ,$userData[$i]->name
                        ,$userData[$i]->token
                    ]
                )
                ->at(date('H:i'));
                // dump(date('H:i'));
                // ->at(substr($userData[$i]->send_reservation_time,0,5));
        }

        // 최신 방법 끝

        // $schedule->call(function($userData){
        //     foreach($userData as $data){
        //         Log::info($data->email);
        //     }
        // },['userData' => $userData])->at('14:52');

        // $userData = function(Receiver $receiver){
        //     $userData = $receiver->getFavoriteTime();

        //     return $userData;
        // };

        // $schedule->call(function(Receiver $receiver){
        //     $this->userData = $receiver->getFavoriteTime();
        //     Log::info($this->userData[0]->email);
        // })->at('14:20');

        // $schedule->call(function(){
        //     Log::info($this->userData[0]->email);
        // })->at('14:24');

        // for($i=0;$i<sizeof($abc);$i++){
        //     $schedule->call(function(Receiver $receiver){
        //         $this->userData = $receiver->getFavoriteTime();
        //         Log::info($this->userData[0]->email);
        //     })->at($abc[$i]);
        // }

        // 10:00 사용자 선호 시간 호출 및 스케줄 정의
        // for($i=0;$i<sizeof($this->userData);$i++){
        //     $schedule->call()
        // }

        // $schedule->call('App\Http\Controllers\MailSendController@test',['data'=>'hi'])->at('14:10');

        // $schedule->call(function(Receiver $receiver,$schedule){
        //     $this->userData = $receiver->getFavoriteTime();
        //     for($i=0;$i<sizeof($this->userData);$i++){
        //         $schedule->call('App\Http\Controllers\MailSendController@test',['data'=>'hi'])
        //         ->at('14:15');
        //     }
        // },['schedule'=>$schedule])->at('14:14');
        // $schedule->call(function (){
        //     foreach($this->userData as $data){
        //         Log::info($data->email);
        //     };
        // })->at('13:35');



        // 메일발송 스케줄링 방법 1 시작 (실패)
        // $schedule->call(function (Receiver $receiver) {
        //     $userData = $receiver->getFavoriteTime();
        //     foreach($userData as $data){
        //         // 사용자 선호시간별 메일 발송 스케줄 정의
        //         // $this->schedule->call('MailSendController@sendMail')->at($data->send_reservation_time);
        //             Log::info('동적스케줄링!');
        //             // Log::info(substr($data->send_resevation_time,0,6));
        //             //               send_resevation_time
        //         // 테스트
        //         $schedule->call(function () {
        //             Log::info('사용자 선호시간 메일 발송');
        //         })->at(substr($data->send_resevation_time,0,6));
        //     }
        // })->at('12:51');
        // 방법1 끝


        // 매일 자정 사용자 선호 메일발송시간 업데이트
        // $schedule->call('ReceiverController@calculTime')->at('23:59');
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
