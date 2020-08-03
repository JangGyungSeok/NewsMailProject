<?php

namespace App\Exceptions;

use App\Service\TelegramService;
use Illuminate\Support\Facades\Log;
use Exception;

class ChangedArchitectureException extends Exception
{
    protected $telegramService;
    public function __construct()
    {
        $this->telegramService = new TelegramService;
    }

    public function exceptionLog(){
        Log::info('크롤링 페이지 구조가 변경된 것 같습니다.');
    }

    public function report()
    {
        $this->exceptionLog();
        $this->telegramMessage();
    }

    public function telegramMessage()
    {
        $this->telegramService->message("ChangedArchitecture");
    }
}
