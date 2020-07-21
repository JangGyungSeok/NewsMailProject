<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use \App\ReceiveTimeLog;
class GatewayController extends Controller
{
    // 요청 정보를 확인할 수 있는 Request객체를 사용
    public function enterGateway(Request $request){


        // Log::info($request -> query('url'));
        // 수신자 확인 로직 실행
        // 수신자별 접근시간 적재로직 실행

        // ReceiveTimeLog::insert();

        return Redirect($request -> query('url'));
    }
}
