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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware'=>'auth'],function (){
    Route::get('/editProfile','profileController@editProfile');

    Route::post('/editProfile/edit','profileController@updateprofile');

    Route::get('/friends','friendscontroller@index');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/add', 'friendscontroller@befriend');
    Route::get('/findFriends', 'friendscontroller@findfriends');

});