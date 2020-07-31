<?php

namespace App\Exceptions;

use Exception;
use App\Service\TelegramService;
use Illuminate\Support\Facades\Log;

class CustomException extends Exception
{
    protected $telegramService;
    protected $situation;

    public function __construct($situation)
    {
        $this->situation = $situation;
        $this->telegramService = new TelegramService;
    }

    # exception 발생 시 telegram메시지 발송
    # 매개변수로 넘어온 situation 문자열에 따라 다른 메시지 발송
    public function report()
    {
        Log::info($this->situation);
        $this->telegramMessage($this->situation);
    }

    public function render()
    {
        if ($this->situation == 'NotReceiver') {
            return '미확인 사용자';
        } elseif ($this->situation == 'NewsIsChanged') {
            return '뉴스기사가 변경 또는 삭제되었습니다.';
        }
    }

    public function telegramMessage($situation)
    {
        $this->telegramService->message($situation);
    }
}
