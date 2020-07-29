<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Service\CrawlerService;
use Illuminate\Support\Facades\Log;

class CrawlingSchedule extends Command
{

    protected $crawlerService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CrawlingSchedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawling logic start';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    // 의존성 주입
    public function __construct(CrawlerService $crawlerService)
    {
        parent::__construct();
        $this->crawlerService = $crawlerService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    // 크롤링 메서드 실행
    public function handle()
    {
        Log::info('크롤링 스케줄 시작!');

        $this->crawlerService->crawlingNews();

        Log::info('크롤링 스케줄 끝!');
    }
}
