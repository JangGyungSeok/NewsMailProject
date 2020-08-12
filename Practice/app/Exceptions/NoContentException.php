<?php

namespace App\Exceptions;

use App\Service\TelegramService;
use Illuminate\Support\Facades\Log;
use Exception;


// 크롤링에 성공했으나 텍스트가 비어있는경우
class NoContentException extends Exception
{
    protected $telegramService;

    public function __construct()
    {
        $this->telegramService = new TelegramService;
    }

    public function exceptionLog(){
        Log::info('크롤링에 성공했으나 빈 값을 받아왔습니다.');
    }
    public function report()
    {
        $this->exceptionLog();
        $this->telegramMessage();
    }

    public function telegramMessage()
    {
        $this->telegramService->message("NoContent");
    }
}
