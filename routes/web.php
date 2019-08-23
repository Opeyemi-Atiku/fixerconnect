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
/*
* Main landing page
*/
Route::group(['prefix' => '/'], function(){
  Route::get('/', 'LandingController@index')->name('landing.homepage');
  Route::get('about', 'LandingController@about')->name('landing.about');
  Route::get('contact', 'LandingController@contact')->name('landing.contact');
});

/*
* User registration and authenticated route
*/

Route::group(['prefix' => 'user', 'middleware' => ['guest']], function(){
  Route::get('register', 'UserController@register')->name('user.register');
  Route::post('register', 'UserController@registration')->name('user.registration');
  Route::get('login', 'UserController@login')->name('user.login');
});

/*
* after authenticate
*/

Route::group(['prefix' => '/', 'middleware' => ['auth']], function(){
  Route::get('logout', 'UserController@logout')->name('user.logout');

  Route::group(['middleware' => ['account']], function(){
    Route::get('/redirect_dashboard', 'UserController@redirect')->name('user.redirect');

    Route::group(['prefix' => 'profile'], function(){
      Route::get('technician', 'TechnicianController@profile');
      Route::get('residential', 'EmployerController@profile');
      Route::get('commercial', 'EmployerController@profile');
    });
    Route::group(['prefix' => 'dashboard'], function(){
      Route::get('technician', 'TechnicianController@dashboard');
      Route::get('residential', 'EmployerController@dashboard');
      Route::get('commercial', 'EmployerController@dashboard');
    });
  });
  Route::group(['middleware' => ['account_set']], function(){
    Route::get('/set_account_type', 'UserController@setAccount')->name('user.setAccount');
    Route::post('/set_account_type', 'UserController@accountSet')->name('user.accountSet');
  });

});
