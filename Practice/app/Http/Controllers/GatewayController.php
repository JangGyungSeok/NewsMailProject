<?php

namespace App\Http\Controllers;

use \App\Service\GatewayService;
use \App\Service\TelegramService;
use Illuminate\Http\Request;

class GatewayController extends Controller
{

    private $gatewayService;

    public function __construct(GatewayService $gatewayService)
    {
        $this->gatewayService = $gatewayService;
    }

    public function enterGateway(Request $request){
        return $this->gatewayService->enterGateway($request);
    }

    public function testGateway(){
        $temp = new TelegramService;
        return $temp->testMessage();
    }
}
