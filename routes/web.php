<?php

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

Route::any('/wechat', 'WeChatController@serve')->name('wechat');

// Route::get('/test', function() {
//     return view('payment.pay');
// });
// Route::group(['middleware' => 'mock.user'], function() {
//     // Route::get('/', function () {
//     //     $user = session('wechat.oauth_user.default'); // 拿到授权用户资料
//     //     dd($user);
//     // });
//     Route::get('/', 'PagesController@root')->name('pages.root');
//     Route::get('/linked', 'PagesController@search')->name('pages.search');
//     Route::post('/linked', 'PagesController@linked')->name('pages.linked');
//     Route::get('/show/{id}', 'PagesController@show')->name('pages.show');
//     Route::get('/custom/{id}/{dh}/{je}', 'PagesController@customize')->name('pages.custom');
//     Route::get('/cancel/{id}', 'PagesController@cancel')->name('pages.cancel');
//     Route::post('/pay', 'PaymentController@pay')->name('pay');
//     Route::get('/pay/show', 'PaymentController@show')->name('pay.show');
//     Route::get('/pay/amount', 'PaymentController@inputAmout')->name('pay.amout');

// });

Route::post('/notify_url', 'NotifyController@notify')->name('notify_url');

Route::group(['middleware' => ['wechat.oauth:snsapi_userinfo']], function () {
    Route::get('/user', function () {
        $user = session('wechat.oauth_user.default'); // 拿到授权用户资料
        dd($user);
        // dd($user->nickname); ʟɪʟᴜᴇ_
    });
    Route::get('/', 'PagesController@root')->name('pages.root');
    Route::get('/linked', 'PagesController@search')->name('pages.search');
    Route::post('/linked', 'PagesController@linked')->name('pages.linked');
    Route::get('/show/{id}', 'PagesController@show')->name('pages.show');
    Route::get('/custom/{id}/{dh}/{je}', 'PagesController@customize')->name('pages.custom');
    Route::get('/cancel/{id}', 'PagesController@cancel')->name('pages.cancel');
    Route::post('/pay', 'PaymentController@pay')->name('pay');
    Route::get('/notice/{trade}', 'PaymentController@payments')->name('notice');
});



