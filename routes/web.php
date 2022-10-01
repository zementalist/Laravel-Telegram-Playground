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

Route::get('/test', function() {
    return json_encode(['text' => "Hello WOrld"]);
});


Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get("/about", "pageController@index");
Route::resource('posts', 'postsController');
Auth::routes();

Route::get("/telactivity", "TelegramController@activity");
Route::get("/telsend", "TelegramController@send");
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get("/telcheck", "TelegramController@check_msg");
Route::get("/startMessaging", function() {
    return view("telegram");
});