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
    return view('welcome');
});

Auth::routes();


Route::get('/manage', 'ManageController@index')->name('manage');
Route::get('manage/sermons', 'ManageController@sermons')->name('sermons');

Route::get('manage/add_sermon', 'ManageController@add_sermons')->name('add_sermon');
Route::post('manage/add_sermon', 'ManageController@store_sermons')->name('add_sermon');

Route::get('manage/churches/photo/{church}', 'ManageController@add_photo')->name('add_photo');
Route::post('manage/churches/photo/{church}', 'ManageController@store_photo')->name('store_photo');
Route::get('manage/churches/{church_id}/photo/edit/{photo_id}', 'ManageController@edit_photo')->name('edit_photo');
Route::put('manage/churches/{church_id}/photo/edit/{photo_id}', 'ManageController@update_photo')->name('update_photo');
Route::get('manage/photo/delete/{photo_id}', 'ManageController@delete_photo')->name('delete_photo');


Route::get('manage/churches', 'ManageController@churches')->name('churches');
Route::get('manage/churches/edit/{church}', 'ManageController@churchEdit')->name('church.edit');
Route::put('manage/churches/edit/{church}', 'ManageController@churchUpdate')->name('church.update');
Route::get('manage/add_church', 'ManageController@add_church')->name('add_church');
Route::post('manage/add_church', 'ManageController@store_churches')->name('add_church');
Route::get('manage/churches/delete/{church}', 'ManageController@destroyChurch')->name('church.delete');
Route::get('manage/churches/view/{church}', 'ManageController@showChurch')->name('church.view');
Route::post('manage/church/services/{church}', 'ManageController@addService')->name('add.service');

Route::get('manage/users', 'ManageController@users')->name('users');
Route::get('manage/add_user', 'ManageController@add_user')->name('add_user');
Route::post('manage/add_user', 'ManageController@store_users')->name('add_user');
Route::get('/manage/users/edit/{user}', 'ManageController@edit_users')->name('edit_user');



Route::get('manage/audios', 'ManageController@audios')->name('audios');
Route::get('manage/add_audio', 'ManageController@add_audio')->name('add_audio');
Route::post('manage/add_audio', 'ManageController@store_audio')->name('store_audio');
Route::post('manage/audios/multipledelete/', 'ManageController@audioMultipleDelete')->name('audios.multipledel');
Route::get('/manage/audio/delete/{audio}', 'ManageController@delete_audio')->name('delete_audio');
Route::get('/manage/audio/listen/{audio}', 'ManageController@listen_audio')->name('listen_audio');

Route::get('manage/add_video', 'ManageController@video')->name('video');
Route::get('manage/video_list', 'ManageController@allvideo')->name('allvideo');
Route::post('manage/add_video', 'ManageController@add_video')->name('add_video');
Route::get('/manage/videos/delete/{video}', 'ManageController@delete_video')->name('delete_video');

Route::get('manage/sermons/view/{sermon}', 'ManageController@show')->name('sermons.view');
Route::get('manage/sermons/edit/{sermon}', 'ManageController@edit')->name('sermons.edit');
Route::put('manage/sermons/edit/{sermon}', 'ManageController@update')->name('sermons.update');
Route::get('manage/sermons/delete/{sermon}', 'ManageController@destroy')->name('sermons.delete');

Route::post('manage/sermons/activation/', 'ManageController@postallow')->name('sermons.postallow');
Route::get('manage/churches/gallery/{church}', 'ManageController@gallery')->name('church.gallery');


Route::get('/manage/search', 'ManageController@searchquery')->name('search');
Route::get('/user/search', 'UserController@searchquery')->name('search');
Route::get('user/sermons/view/{sermon}', 'UserController@show_sermon')->name('sermons.show');
Route::get('user/audios', 'UserController@audios')->name('audios');
Route::get('/user/audio/listen/{audio}', 'UserController@listen_audio')->name('listen_audio');

Route::get('/user', 'UserController@index')->name('user');

Route::get('/manage/users/delete/{user}', 'ManageController@delete_users')->name('delete_user');
Route::get('/manage/services/delete/{service}', 'ManageController@delete_service')->name('delete_service');

Route::get('manage/premium_video', 'ManageController@premiumvideo')->name('premiumvideo');
Route::get('manage/premium_add_video', 'ManageController@add_premium')->name('add_premium_video');

Route::get('api/sermons', 'ApiController@sermons');
Route::get('api/sermons/{sermon}', 'ApiController@getsermon');


Route::get('api/audios', 'ApiController@audios');
Route::get('api/audios/{audio}','ApiController@getaudio');
Route::get('api/videos', 'ApiController@videos');
Route::get('api/videos/{video}','ApiController@getvideo');



