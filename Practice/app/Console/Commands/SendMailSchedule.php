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
    protected $signature = 'command:SendMailSchedule {idx} {email} {token} {send_resevation_time}';

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
        $userData =(object) ['idx' => $this->argument('idx')
                ,'email' => $this->argument('email')
                ,'token' => $this->argument('token')
                ,'send_reservation_time' => $this->argument('send_reservation_time')
        ];

        // Log::info($userData);
        // foreach($userData as $data){
        //     Log::info($data->email);
        // }
        Log::info('메일발송 스케줄 실행!');
        return $this->mailSendController->sendMail($userData);
    }
}
