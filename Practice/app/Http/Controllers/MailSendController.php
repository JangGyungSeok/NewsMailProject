<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MailSendService;

class MailSendController extends Controller
{
    private $mailSendService;

    public function __construct(MailSendService $mailSendService)
    {
        $this->mailSendService = $mailSendService;
    }

    // 메일발송 메서드 실행
    public function sendMail($userData){
        return $this->mailSendService->sendMail($userData);
    }
}
