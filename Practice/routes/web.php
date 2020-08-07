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

Route::get('/dashBoard', 'DashBoardController@home');

Route::get('/dashBoard/receivers', 'DashBoardController@receivers');

Route::get('/dashBoard/allNews', 'DashBoardController@allNews');

Route::get('/dashBoard/mailSendLog', 'DashBoardController@mailSendLog');
Route::get('/dashBoard/mailSendLog/mailSendLogDetail/{mail_date}', 'DashBoardController@mailSendLogDetail');



Route::get('/gateway','GatewayController@enterGateway');

Route::get('/getAllReceiver', 'AjaxController@getAllReceiver');
Route::get('/getReceiverBySendReservationTime', 'AjaxController@getReceiverBySendReservationTime');
Route::get('/getAllSendMailLog', 'AjaxController@getAllSendMailLog');
Route::get('/getSendMailLogByMailDate', 'AjaxController@getSendMailLogByMailDate');



Route::get('/test', function () {
    return view('/dashboard/test');
});
