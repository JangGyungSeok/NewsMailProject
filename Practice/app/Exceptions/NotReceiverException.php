<?php

namespace App\Exceptions;

use App\Service\TelegramService;
use Illuminate\Support\Facades\Log;
use Exception;

// 수신자 정보 테이블에 없는 접근
class NotReceiverException extends Exception
{
    protected $telegramService;

    public function __construct()
    {
        $this->telegramService = new TelegramService;
    }

    public function exceptionLog(){
        Log::info('미확인 사용자의 접근입니다.');
    }
    public function report()
    {
        $this->exceptionLog();
        $this->telegramMessage();
    }

    public function render()
    {
        return '미확인 사용자 입니다.';
    }

    public function telegramMessage()
    {
        $this->telegramService->message("NotReceiver");
    }
}
