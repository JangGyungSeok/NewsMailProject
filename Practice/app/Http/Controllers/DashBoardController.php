<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function test(){
        return view('/dashboard/dashboard');
    }
}
