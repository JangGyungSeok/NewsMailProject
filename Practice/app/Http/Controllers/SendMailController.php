<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\SendMailService;
use App\Service\TelegramService;

class SendMailController extends Controller
{
    private $mailSendService;
    private $telegramService;

    public function __construct(
        SendMailService $sendMailService,
        TelegramService $telegramService
    ) {
        $this->mailSendService = $sendMailService;
        $this->telegramService = $telegramService;
    }

    // 메일발송 메서드 실행
    public function sendMail($userData)
    {
        // 메일발송 서비스 결과값으로 situation string발생
        $result = $this->sendMailService->sendMail($userData);
    }
}
