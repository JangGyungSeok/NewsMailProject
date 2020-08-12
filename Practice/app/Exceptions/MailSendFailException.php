<?php

namespace App\Exceptions;

use App\Service\TelegramService;
use Illuminate\Support\Facades\Log;
use Exception;

// API는 정상동작하나 메일발송이 실패한경우
class MailSendFailException extends Exception
{
    protected $telegramService;
    public function __construct()
    {
        $this->telegramService = new TelegramService;
    }

    public function exceptionLog(){
        Log::info('API는 정상작동하나 발송이 실패했습니다.');
    }

    public function report()
    {
        $this->exceptionLog();
        $this->telegramMessage();
    }

    public function telegramMessage()
    {
        $this->telegramService->message("MailSendFail");
    }
}
