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


// Route::get('/MailLog', 'DashBoardController@test');
// Route::get('/ReceiveLog', 'DashBoardController@test');
// Route::get('/abc','CrawlerController@crawlingNews');

// Route::get('/sendMail','MailSendController@sendMail');


// Route::get('/test','GatewayController@testGateway');

// Route::get('/testTelegram',function(){
//     return '안녕하세요?1';
// });
// Route::get('/testTelegram/test',function(){
//     return '안녕하세요?';
// });
// https://api.telegram.org/bot1251668721:AAGF_dVMoDf4eUvXwGHqgbp5N3FJUdmmVAI/setWebhook?url=https://172.20.38.69/testTelegram
