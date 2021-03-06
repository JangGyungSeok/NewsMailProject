<?php

namespace App\Exceptions;

use App\Service\TelegramService;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Container\Container;

class NotGoodCSSSelectorException extends Exception
{
    protected $telegramService;

    public function __construct()
    {
        // $container = Container::getInstance();
        // $this->telegramService = $container->make(TelegramService::class);
        $this->telegramService = new TelegramService;
    }

    public function exceptionLog(){
        Log::info('CSS Selector가 부정확합니다.');
    }
    public function report()
    {
        $this->exceptionLog();
        $this->telegramMessage();
    }

    public function telegramMessage()
    {
        $this->telegramService->message("NotGoodCSSSelector");
    }
}
