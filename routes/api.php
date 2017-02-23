<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::get('tours', 'ApiController@getTours');
Route::group(array('prefix'=>'/v1'), function(){
	Route::get('news', 'ApiController@getNews')	;
	Route::get('user', 'ApiController@getUser');
	Route::get('promotions', 'ApiController@getPromotions');
	Route::get('video-ar','ApiController@getVideoAr');
	Route::post('buy-money', 'ApiController@postBuyMoney');
	Route::post('verify-code', 'ApiController@postVerifyCode');
	Route::get('history','ApiController@getHistory');
	Route::post('tours', 'ApiController@postListTours');
	Route::post('tickets','ApiController@postBuyTickets');
	Route::post('detail-ticket','ApiController@postDetailTicket');
	Route::post('comment', 'ApiController@postComment');
	Route::post("rate", 'ApiController@postRate');
	Route::post('register', 'ApiController@postRegister');
	Route::post('login', 'ApiController@postLogin');
	Route::get('tours', 'ApiController@getTours');
});
