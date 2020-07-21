<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CrawlerController;
use Illuminate\Support\Facades\Log;

class CrawlingSchedule extends Command
{

    protected $crawlerController;
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
    protected $description = 'Crawling login start';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    // 의존성 주입
    public function __construct(CrawlerController $crawlerController)
    {
        parent::__construct();
        $this->crawlerController = $crawlerController;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    // 크롤링 메서드 실행
    public function handle()
    {
        Log::info('크롤링 스케줄 실행!');
        return $this->crawlerController->crawlingNews();
    }
}
