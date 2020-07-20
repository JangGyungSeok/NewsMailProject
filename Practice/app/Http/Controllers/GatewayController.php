<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GatewayController extends Controller
{
    public function enterGateway(Request $request){


        Log::info($request -> query('url'));
        return Redirect($request -> query('url'));
    }
}
