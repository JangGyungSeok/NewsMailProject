<?php

namespace Tests\Feature;

use App\Receiver;
use App\Repository\ReceiverRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ReceiverRepositoryTest extends TestCase
{
    protected $receiverRepository;
    protected $uid;
    protected $favoriteTime;

    public function initData()
    {
        $this->receiverRepository = new ReceiverRepository(new Receiver());
        $this->uid = 1;
        $this->favoriteTime = date('H:i:s');
    }

    public function testIsReceiver()
    {
        $this->initData();
        Log::info('ReceiverRepository -> isReceiver(uid) 테스트 시작');
        $this->assertNotNull($this->receiverRepository->isReceiver($this->uid));
        Log::info('ReceiverRepository -> isReceiver(uid) 테스트 끝');
    }

    public function testGetFavoriteTime()
    {
        $this->initData();
        Log::info('ReceiverRepository -> getFavoriteTime() 테스트 시작');
        $this->assertNotNull($this->receiverRepository->getFavoriteTime());
        Log::info('ReceiverRepository -> getFavoriteTime() 테스트 끝');
    }

    // public function testUpdateReservationTime()
    // {
    //     $this->initData();
    //     $this->assertNotNull($this->receiverRepository->updateReservationTime($this->uid,$this->favoriteTime));
    // }

    public function testGetAll()
    {
        $this->initData();
        Log::info('ReceiverRepository -> getAll() 테스트 시작');
        $this->assertNotNull($this->receiverRepository->getAll());
        Log::info('ReceiverRepository -> getAll() 테스트 끝');
    }
}
// public function isReceiver($uid)
// public function getFavoriteTime()
// public function updateReservationTime($uid, $favoriteTime)
// public function getAll()
