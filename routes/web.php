<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\News;

Route::get('/', function () {
    return view('login_v2');
});

//Testing
Auth::routes();
Route::post('/register', 'HomeController@postRegister');

Route::get('/home', 'HomeController@index');

Route::group(array('prefix'=>'administrator'), function(){
    Route::get('/', 'AdminController@getHome');
    Route::get('index', 'AdminController@getHome');
    Route::get('home', 'AdminController@getHome');

    Route::get('news', 'AdminController@getNews');
    Route::post('news/create', 'AdminController@postCreateNews');
    Route::post('news/update', 'AdminController@postUpdateNews');
    Route::post('news/delete', 'AdminController@postDeleteNews');

    Route::get('tours', 'AdminController@getTours');
    Route::get('tours/json', 'AdminController@getToursJson');
    Route::post('tours/create', 'AdminController@postCreateTours');
    Route::post('tours/update', 'AdminController@postUpdateTours');
    Route::post('tours/delete', 'AdminController@postDeleteTours');


    Route::get('promotions', 'AdminController@getPromotions');
    Route::post('promotions/update', 'AdminController@postUpdatePromotions');
    Route::post('promotions/create', 'AdminController@postCreatePromotions');
    Route::post('promotions/delete', 'AdminController@postDeletePromotions');

    Route::get('video', 'AdminController@getVideo');
    Route::post('video/create', 'AdminController@postCreateVideo');

    Route::get('users', 'AdminController@getUsers');
    Route::get('admin', 'AdminController@getAdmin');
});

Route::get('logout', 'AdminController@getLogout');

/*Route::get('/news', 'HomeController@getNews');
Route::post('/news', 'HomeController@postNews');

Route::get('/staff', 'HomeController@getStaff');
Route::post('/staff', 'HomeController@postStaff');

Route::get('/tour','HomeController@getWisataBudaya');
Route::post('/tour','HomeController@postWisataBudaya');*/

Route::get('/token', function(){return csrf_token();});

Route::get('/images/{filename}', function ($filename)
{
    $path = storage_path() . '/app/public/' . $filename;

    if(!File::exists($path)) return abort('404');

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('/images/tours/{filename}', function ($filename)
{
    $path = storage_path() . '/app/tours/' . $filename;

    if(!File::exists($path)) return abort('404');

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('/images/promotions/{filename}', function ($filename)
{
    $path = storage_path() . '/app/promotions/' . $filename;

    if(!File::exists($path)) return abort('404');

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('/images/news/{filename}', function ($filename)
{
    $path = storage_path() . '/app/news/' . $filename;

    if(!File::exists($path)) return abort('404');

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('/images/marker/{filename}', function ($filename)
{
    $path = storage_path() . '/app/marker/' . $filename;

    if(!File::exists($path)) return abort('404');

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('/video/{filename}', function ($filename)
{  
    $path = storage_path() . '/app/video/' . $filename;

    if(!File::exists($path)) return abort('404');

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Auth::routes();

Route::get('/bridge', function() {
    $data = News::first();
    
    $pusher = App::make('pusher');

    $pusher->trigger( 'scantour_event_channel',
                      'data_event', array('title'=>'Pertunjukan Seni Budaya'));

    return "Success";
});