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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/abc','CrawlerController@crawlingNews');

Route::get('/sendMail','MailSendController@sendMail');

Route::get('/gateway','GatewayController@enterGateway');

Route::get('/test','GatewayController@testGateway');

Route::get('/testTelegram',function(){
    return '안녕하세요?1';
});
Route::get('/testTelegram/test',function(){
    return '안녕하세요?';
});
// https://api.telegram.org/bot1251668721:AAGF_dVMoDf4eUvXwGHqgbp5N3FJUdmmVAI/setWebhook?url=https://172.20.38.69/testTelegram
