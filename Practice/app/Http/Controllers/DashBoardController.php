<?php

namespace App\Http\Controllers;

use App\Service\DashBoardService;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    private $dashBoardService;

    public function __construct(DashBoardService $dashBoardService)
    {
        $this->dashBoardService = $dashBoardService;
    }

    public function test(){
        $mailSendLog = $this->dashBoardService->abc();
        return view(
            '/dashboard/dashboard',
            [
                'mailSendLog' => $mailSendLog
            ]
        );
    }

    public function mailSendLogDetail($mail_date){
        $receiveTimeLogDetail = $this->dashBoardService->mailSendLogDetail($mail_date);
        return view(
            '/dashboard/mailSendLogDetail',
            [
                'receiveTimeLogDetail' => $receiveTimeLogDetail
            ]
        );
    }
}
