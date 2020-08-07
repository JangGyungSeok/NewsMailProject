<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Repository\NewsDataRepository;
use App\Repository\ReceiverRepository;
use App\Service\SendMailService;

use function PHPSTORM_META\map;

class SendMailSchedule extends Command
{

    protected $mailSendService;
    protected $newsDataRepository;
    protected $receiverRepository;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // command명과 필요한 parameters 정의
    protected $signature = 'command:SendMailSchedule';

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
    public function __construct(
        SendMailService $sendMailService,
        NewsDataRepository $newsDataRepository,
        ReceiverRepository $receiverRepository
    ) {
        parent::__construct();
        $this->sendMailService = $sendMailService;
        $this->newsDataRepository = $newsDataRepository;
        $this->receiverRepository = $receiverRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 비즈니스로직을 schedule -> command 이동

        // 오늘자 크롤링한 뉴스가 없다면 실행하지 않는다.
        if ($this->newsDataRepository->checkNews()) {
        // if (true) {
            // 크롤링할 뉴스가 있다면 사용자 정보를 불러온다.
            $receiverData = $this->receiverRepository->getAll();

            // foreach문으로 mailSendService -> sendMail메서드 실행
            // 단 현재시간이 메일발송예약시간이 아니라면 발송하지 않는다.
            foreach ($receiverData as $data) {
                Log::info('시간정보',['현재시간대'=>date('H:i:00'),'선호시간대'=>$data->send_reservation_time]);
                // if (date("H:00:00") == $data->send_reservation_time) {
                if(true){
                    Log::info('메일발송 스케줄 실행!',['id' => $data->idx]);
                    $this->sendMailService->sendMail($data);
                    Log::info('메일발송 스케줄 종료');
                }
            }
        }

    }
}
