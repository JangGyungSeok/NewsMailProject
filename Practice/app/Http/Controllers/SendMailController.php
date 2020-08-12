<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\SendMailService;

class SendMailController extends Controller
{
    private $mailSendService;

    public function __construct(
        SendMailService $sendMailService
    ) {
        $this->mailSendService = $sendMailService;
    }

    // 메일발송 메서드 실행
    public function sendMail($userData)
    {
        // 메일발송 서비스 결과값으로 situation string발생
        $result = $this->sendMailService->sendMail($userData);
    }
}
