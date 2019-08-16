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

Route::group(['prefix'=> '/'], function(){
  Route::get('/', 'LandingController@index')->name('landing.homepage');
  Route::get('/about', 'LandingController@about')->name('landing.homepage');
});

/*Route::group(['middleware'] => ['auth'], function(){
  Route::resource('/', 'HomeController', [
    'only' => ['index']
  ]);
});*/
