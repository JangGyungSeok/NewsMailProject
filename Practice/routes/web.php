<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 유입 시 dashboard로 redirect
Route::get('/',function () {
    return redirect('/dashBoard');
});

// 대시보드 메인
Route::get('/dashBoard', 'DashBoardController@home');

// 메일 수신자 페이지
Route::get('/dashBoard/receivers', 'DashBoardController@receivers');

// 크롤링한 기사 조회 페이지
Route::get('/dashBoard/allNews', 'DashBoardController@allNews');

// 메일발송 로그 페이지
Route::get('/dashBoard/mailSendLog', 'DashBoardController@mailSendLog');
// 메일발송 로그 상세페이지
Route::get('/dashBoard/mailSendLog/mailSendLogDetail/{mail_date}', 'DashBoardController@mailSendLogDetail');

// gateway 접근처리 페이지
Route::get('/gateway','GatewayController@enterGateway');


// ajax를 위한 route
Route::get('/getAllReceiver', 'AjaxController@getAllReceiver');
Route::get('/getReceiverBySendReservationTime', 'AjaxController@getReceiverBySendReservationTime');
Route::get('/getAllSendMailLog', 'AjaxController@getAllSendMailLog');
Route::get('/getSendMailLogByMailDate', 'AjaxController@getSendMailLogByMailDate');
