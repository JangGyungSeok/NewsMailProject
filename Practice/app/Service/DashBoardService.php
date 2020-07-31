<?php

namespace App\Service;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Repository\NewsDataRepository;
use App\Repository\MailSendLogRepository;
use App\Repository\ReceiverRepository;
use App\Repository\ReceiveTimeLogRepository;

class DashBoardService
{
    protected $mailSendLogRepository;
    protected $receiveTimeLogRepository;
    protected $newsDataRepository;
    protected $receiverRepository;

    public function __construct(
        MailSendLogRepository $mailSendLogRepository,
        ReceiveTimeLogRepository $receiveTimeLogRepository,
        NewsDataRepository $newsDataRepository,
        ReceiverRepository $receiverRepository
    ) {
        $this->newsDataRepository = $newsDataRepository;
        $this->mailSendLogRepository = $mailSendLogRepository;
        $this->receiveTimeLogRepository = $receiveTimeLogRepository;
        $this->receiverRepository = $receiverRepository;
    }

    public function mailSendLog()
    {
        $mailSendLog = $this->mailSendLogRepository->getLogTableContent();
        return view(
            '/dashboard/dashboard',
            [
                'mailSendLog' => $mailSendLog
            ]
        );
    }

    public function mailSendLogDetail($mail_date)
    {
        $mailContent = $this->newsDataRepository->getMailContentByDate($mail_date);
        $receiveTimeLogDetail = $this->receiveTimeLogRepository->getLogBymailDate($mail_date);

        return view(
            '/dashboard/mailSendLogDetail',
            [
                'mailContent' => $mailContent,
                'receiveTimeLogDetail' => $receiveTimeLogDetail
            ]
        );
    }

    public function allNews(){
        $allNews = $this->newsDataRepository->getAll();

        return view(
            '/dashboard/allNews',
            [
                'allNews' => $allNews
            ]
        );
    }

    public function allReceiver(){
        $allReceiver = $this->receiverRepository->getAll();

        return view(
            '/dashboard/receivers',
            [
                'allReceiver' => $allReceiver
            ]
        );
    }
}
