<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use \App\Service\CrawlerService;
use App\Service\TelegramService;

class CrawlerController extends Controller
{
    private $crawlerService;
    private $telegramService;

    public function __construct(CrawlerService $crawlerService, TelegramService $telegramService)
    {
        $this->crawlerService = $crawlerService;
        $this->telegramService = $telegramService;
    }


    public function crawlingNews(){
        $result = $this->crawlerService->crawlingNews();

        if ($result != 'Success'){
            $this->telegramService->message($result);
        }
    }

}
