<?php

namespace App\Exceptions;

use App\Service\TelegramService;
use Illuminate\Support\Facades\Log;
use Exception;

class MailAPIFailException extends Exception
{
    protected $telegramService;
    public function __construct()
    {
        $this->telegramService = new TelegramService;
    }

    public function exceptionLog(){
        Log::info('메일발송 API가 문제있습니다.');
    }

    public function report()
    {
        $this->exceptionLog();
        $this->telegramMessage();
    }

    public function telegramMessage()
    {
        $this->telegramService->message("MailAPIFail");
    }
}
