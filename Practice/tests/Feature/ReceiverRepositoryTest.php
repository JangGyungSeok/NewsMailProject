<?php

namespace Tests\Feature;

use App\Receiver;
use App\Repository\ReceiverRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->assertNotNull($this->receiverRepository->isReceiver($this->uid));
    }

    public function testGetFavoriteTime()
    {
        $this->initData();
        $this->assertNotNull($this->receiverRepository->getFavoriteTime());
    }

    // public function testUpdateReservationTime()
    // {
    //     $this->initData();
    //     $this->assertNotNull($this->receiverRepository->updateReservationTime($this->uid,$this->favoriteTime));
    // }

    public function testGetAll()
    {
        $this->initData();
        $this->assertNotNull($this->receiverRepository->getAll());
    }
}
// public function isReceiver($uid)
// public function getFavoriteTime()
// public function updateReservationTime($uid, $favoriteTime)
// public function getAll()
