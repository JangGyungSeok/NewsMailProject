<?php

namespace Tests\Feature;

use App\NewsData;
use App\Repository\NewsDataRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->data = array(date('Y-m-d'), 'dummy_test', 'localhost:8000/dashboard');
        $this->idx = 1;
        $this->news_date = date('Y-m-d');
    }

    public function testInsertNews()
    {
        $this->initData();
        $this->assertNotNull($this->newsDataRepository->insertNews($this->data));
    }

    public function testGetAll()
    {
        $this->initData();
        $this->assertNotNull($this->newsDataRepository->getAll());
    }

    public function testChangeUrl()
    {
        $this->initData();
        $this->assertNotNull($this->newsDataRepository->changeUrl($this->idx));
    }

    public function testGetNewsByIdx()
    {
        $this->initData();
        $this->assertNotNull($this->newsDataRepository->getNewsByIdx($this->idx));
    }

    public function testGetNewsByDate()
    {
        $this->initData();
        $this->assertNotNull($this->newsDataRepository->getNewsByDate($this->news_date));
    }

    public function testGetMailContentByDate()
    {
        $this->initData();
        $this->assertNotNull($this->newsDataRepository->getMailContentByDate($this->news_date));
    }
}


