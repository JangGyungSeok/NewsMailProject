<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MailSendController;
use Illuminate\Support\Facades\Log;

use function PHPSTORM_META\map;

class SendMailSchedule extends Command
{

    protected $mailSendController;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // command명과 필요한 parameters 정의
    protected $signature = 'command:SendMailSchedule {idx} {email} {name} {token}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SendMail Method execute';

    /**
     * Create a new command instance.
     *
     * @return void
     */

     // 의존성 주입
    public function __construct(MailSendController $mailSendController)
    {
        parent::__construct();
        $this->mailSendController = $mailSendController;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 파라미터로 넘어온 data들을 object형태로 변환
        $userData =(object) ['idx' => $this->argument('idx')
                ,'email' => $this->argument('email')
                ,'name' => $this->argument('name')
                ,'token' => $this->argument('token')
        ];

        // Log::info($userData);
        // foreach($userData as $data){
        //     Log::info($data->email);
        // }
        Log::info('메일발송 스케줄 실행!');
        // 의존성주입으로 선언한 Controller를 사용해 메일발송로직 실행
        $this->mailSendController->sendMail($userData);
        Log::info('메일발송 스케줄 종료');
    }
}