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

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'auth'],function (){
    Route::get('/myprofile/{slug}', 'ProfilesController@index');
    Route::get('/myprofiles/editprofile','ProfilesController@editprofile');
    Route::get(' /editmyprofile/update','ProfilesController@updateprofile');
    Route::get('/check_status/{id}', 'friendablecontroller@check_status');
    Route::get('/addFriend/{id}', 'friendablecontroller@addFriend');
    Route::get('/acceptFriend/{id}', 'friendablecontroller@acceptFriend');
    Route::get('/removeFriend/{id}', 'friendablecontroller@removeFriend');
    Route::get('/blockFriend/{id}', 'friendablecontroller@blockFriend');
    Route::get('/unblockFriend/{id}', 'friendablecontroller@unblockFriend');
    Route::get('/denyFriend/{id}', 'friendablecontroller@denyFriend');
    Route::get('/friends','friendscontroller@index');
    Route::get('/messaging','messagingcontroller@index');

    Route::get('/blockedrequests','friendscontroller@blocked');
    Route::get('/findFriends','friendscontroller@findfriends');
    Route::get('/friendrequests','friendscontroller@friendrequests');


});