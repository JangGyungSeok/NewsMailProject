<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MailSendService;
use App\Service\TelegramService;

class MailSendController extends Controller
{
    private $mailSendService;
    private $telegramService;

    public function __construct(MailSendService $mailSendService,TelegramService $telegramService)
    {
        $this->mailSendService = $mailSendService;
        $this->telegramService = $telegramService;
    }

    // 메일발송 메서드 실행
    public function sendMail($userData){
        // 메일발송 서비스 결과값으로 situation string발생
        $result = $this->mailSendService->sendMail($userData);

        // situation string으로 상황별 telegram메시지 발송
        if ($result != 'Success'){
            $this->telegramService->Message($result);
        }
    }
}
