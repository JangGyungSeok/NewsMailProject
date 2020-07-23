<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use \App\Service\CrawlerService;

class CrawlerController extends Controller
{
    private $crawlerService;

    public function __construct(CrawlerService $crawlerService)
    {
        $this->crawlerService = $crawlerService;
    }


    public function crawlingNews(){
        $this->crawlerService->crawlingNews();
    }

}
