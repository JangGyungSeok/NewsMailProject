<?php

namespace Tests\Feature;

use App\ReceiveTimeLog;
use App\Repository\ReceiveTimeLogRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ReceiveTimeLogRepositoryTest extends TestCase
{
    protected $receiveTimeLogRepository;
    protected $uid;
    protected $mail_date;

    public function initData()
    {
        $this->receiveTimeLogRepository = new ReceiveTimeLogRepository(new ReceiveTimeLog());
        $this->uid = 1;
        $this->mail_date = date('Y-m-d H:i:s');
    }

    public function testInsertLog()
    {
        $this->initData();
        Log::info('ReceiveTimeLogRepository -> insertLog(uid,mail_date) 테스트 시작');
        $this->assertNotNull(
            $this->receiveTimeLogRepository->insertLog(
                $this->uid, $this->mail_date
            )
        );
        Log::info('ReceiveTimeLogRepository -> insertLog(uid,mail_date) 테스트 끝');
    }

    public function testGetLogByMailDate()
    {
        $this->initData();
        Log::info('ReceiveTimeLogRepository -> getLogByMailDate(mail_date) 테스트 시작');
        $this->assertNotNull(
            $this->receiveTimeLogRepository->getLogByMailDate(
                $this->mail_date
            )
        );
        Log::info('ReceiveTimeLogRepository -> getLogByMailDate(mail_date) 테스트 끝');
    }

    // public function testGetReceiverFavoriteTime()
    // {
    //     $this->initData();
    //     $this->assertNotNull(
    //         $this->receiveTimeLogRepository->getReceiverFavoriteTime()
    //     );
    // }
}

// public function insertLog($uid, $mailDate)
// public function getLogBymailDate($mail_date)
// public function getReceiverFavoriteTime()
