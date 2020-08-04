<?php

namespace Tests\Feature;

use App\ReceiveTimeLog;
use App\Repository\ReceiveTimeLogRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->assertNotNull(
            $this->receiveTimeLogRepository->insertLog(
                $this->uid, $this->mail_date
            )
        );
    }

    public function testGetLogByMailDate()
    {
        $this->initData();
        $this->assertNotNull(
            $this->receiveTimeLogRepository->getLogBymailDate(
                $this->mail_date
            )
        );
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
