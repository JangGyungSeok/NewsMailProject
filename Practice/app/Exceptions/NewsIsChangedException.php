<?php

namespace App\Exceptions;

use App\Service\TelegramService;
use Illuminate\Support\Facades\Log;
use Exception;

// 변경 또는 삭제된 뉴스기사로 접근한경우
class NewsIsChangedException extends Exception
{
    protected $telegramService;

    public function __construct()
    {
        $this->telegramService = new TelegramService;
    }

    # exception 발생 시 telegram메시지 발송
    # 매개변수로 넘어온 situation 문자열에 따라 다른 메시지 발송
    public function report()
    {
        Log::info('변경 또는 삭제된 뉴스기사로 접근');
        $this->telegramMessage($this->situation);
    }

    public function render()
    {
        return '뉴스기사가 변경 또는 삭제되었습니다.';
    }

    public function telegramMessage($situation)
    {
        $this->telegramService->message('NewsIsChanged');
    }
}
