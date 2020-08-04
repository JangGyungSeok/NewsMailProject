<?php

namespace Tests\Feature;

use App\MailSendLog;
use App\Repository\MailSendLogRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MailSendLogRepositoryTest extends TestCase
{
    protected $mailSendLogRepository;
    protected $uid;
    protected $isSuccess;

    public function initData()
    {
        $this->mailSendLogRepository = new MailSendLogRepository(new MailSendLog());
        $this->uid = 1;
        $this->isSuccess = True;
    }

    public function testInsertLog()
    {
        $this->initData();

        $this->assertNotNull(
            $this->mailSendLogRepository
                ->insertLog($this->uid, $this->isSuccess)
        );
    }

    public function testGetLogTableContent()
    {
        $this->initData();
        $this->assertNotNull(
            $this->mailSendLogRepository->getLogTableContent()
        );
    }
}
// public function insertLog($uid, $isSuccess)
// public function getLogTableContent()
