<?php

namespace App\Service;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Repository\NewsDataRepository;
use App\Repository\MailSendLogRepository;
use App\Repository\ReceiveTimeLogRepository;

class DashBoardService
{
    protected $mailSendLogRepository;
    protected $receiveTimeLogRepository;


    public function __construct(
        MailSendLogRepository $mailSendLogRepository,
        ReceiveTimeLogRepository $receiveTimeLogRepository,
        NewsDataRepository $newsDataRepository
    ) {
        $this->newsDataRepository = $newsDataRepository;
        $this->mailSendLogRepository = $mailSendLogRepository;
        $this->receiveTimeLogRepository = $receiveTimeLogRepository;
    }

    public function abc()
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
}
