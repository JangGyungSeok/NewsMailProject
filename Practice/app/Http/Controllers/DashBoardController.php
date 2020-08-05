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

    # 대시보드 메인화면 /dashBoard
    public function home()
    {
        return $this->dashBoardService->home();
    }

    # 메일발송 로그화면 /dashboard/mailSendLog
    public function mailSendLog()
    {
        return $this->dashBoardService->mailSendLog();

    }

    # 메일발송 디테일화면 /dashboard/mailSendLog/mailSendLogDetail
    public function mailSendLogDetail($mail_date)
    {
        return $this->dashBoardService->mailSendLogDetail($mail_date);
    }

    # 뉴스기사 조회페이지 /dashboard/allNews
    public function allNews()
    {
        return $this->dashBoardService->allNews();
    }

    # 메일 수신자 정보 페이지 /dashboard/receivers
    public function receivers()
    {
        return $this->dashBoardService->allReceiver();
    }

}
