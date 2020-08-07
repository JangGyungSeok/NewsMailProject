<?php

namespace Tests\Feature;

use App\NewsData;
use App\Repository\NewsDataRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class NewsDataRepositoryTest extends TestCase
{
    protected $newsDataRepository;
    protected $data;
    protected $idx;
    protected $news_date;

// public function getAll()
// public function checkNews()
// public function changeUrl($idx)
// public function getNewsByIdx($idx)
// public function getNewsByDate($news_date)
// public function getMailContentByDate($news_date, $uid=0)
// public function getNews()
// public function insertNews($data)

    public function initData()
    {
        $this->newsDataRepository = new NewsDataRepository(new NewsData);
        $this->data = array(date('Y-m-d', strtotime('-1 day')), 'dummy_test', 'localhost:8000/dashboard');
        $this->idx = 1;
        $this->news_date = date('Y-m-d');
    }

    public function testInsertNews()
    {
        $this->initData();
        Log::info('NewsDataRepository -> insertNews(data) 테스트 시작');
        $this->assertNotNull($this->newsDataRepository->insertNews($this->data));
        Log::info('NewsDataRepository -> insertNews(data) 테스트 끝');
    }

    public function testGetAll()
    {
        $this->initData();
        Log::info('NewsDataRepository -> getAll() 테스트 시작');
        $this->assertNotNull($this->newsDataRepository->getAll());
        Log::info('NewsDataRepository -> getAll() 테스트 끝');
    }

    public function testChangeUrl()
    {
        $this->initData();
        Log::info('NewsDataRepository -> changeUrl(idx) 테스트 시작');
        $this->assertNotNull($this->newsDataRepository->changeUrl($this->idx));
        Log::info('NewsDataRepository -> changeUrl(idx) 테스트 끝');
    }

    public function testGetNewsByIdx()
    {
        $this->initData();
        Log::info('NewsDataRepository -> getNewsByIdx(idx) 테스트 시작');
        $this->assertNotNull($this->newsDataRepository->getNewsByIdx($this->idx));
        Log::info('NewsDataRepository -> getNewsByIdx(idx) 테스트 끝');
    }

    public function testGetNewsByDate()
    {
        $this->initData();
        Log::info('NewsDataRepository -> getNewsByDate(news_date) 테스트 시작');
        $this->assertNotNull($this->newsDataRepository->getNewsByDate($this->news_date));
        Log::info('NewsDataRepository -> getNewsByDate(news_date) 테스트 끝');
    }

    public function testGetMailContentByDate()
    {
        $this->initData();
        Log::info('NewsDataRepository -> getMailContentByDate(news_date) 테스트 시작');
        $this->assertNotNull($this->newsDataRepository->getMailContentByDate($this->news_date));
        Log::info('NewsDataRepository -> getMailContentByDate(news_date) 테스트 끝');
    }
}


