<?php

namespace Tests\Feature;

use App\MailSendLog;
use App\Repository\MailSendLogRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
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

        Log::info('MailSendLogRepository -> insertLog(uid,isSuccess) 테스트 시작');
        $this->assertNotNull(
            $this->mailSendLogRepository
                ->insertLog($this->uid, $this->isSuccess)
        );
        Log::info('MailSendLogRepository -> insertLog(uid,isSuccess) 테스트 끝');

    }

    public function testGetLogTableContent()
    {
        $this->initData();

        Log::info('MailSendLogRepository -> getLogTableContent() 테스트 시작');
        $this->assertNotNull(
            $this->mailSendLogRepository->getLogTableContent()
        );
        Log::info('MailSendLogRepository -> getLogTableContent() 테스트 끝');
    }
}
// public function insertLog($uid, $isSuccess)
// public function getLogTableContent()
