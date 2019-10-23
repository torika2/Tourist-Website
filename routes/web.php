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

Auth::routes();

Route::get('/','pageController@welcome');
Route::get('/Support','pageController@welcomePage');
Route::get('/Login','pageController@loginPage');
Route::get('/Registration','pageController@registration');
Route::post('/Support','pageController@supportChat')->name('supp');
Route::post('/supportChat','adminController@chatForSupport')->name('supportisation');
Route::get('/adminSupport','adminController@supportChat');
Route::post('/adminChat','adminController@userChat')->name('userChat');
Route::post('/adminCommDelete','adminController@dltComm')->name('deleteComm');
