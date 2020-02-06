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

Route::middleware('auth')->group(function() {
  Route::get('/', 'HomeController@index')->name('home');
  Route::get('/add-account', 'GoogleController@index')->name('add-google-account');
  Route::get('/dashboard', 'HomeController@index')->name('home');
  Route::post('/start/project', 'HomeController@startTracker')->name('start-tracker');
  Route::get('/stop/project/{id}', 'HomeController@stopTracker')->name('stop-tracker');
  Route::get('/check/tracker/session', 'HomeController@checkTrackerSession')->name('check-tracker-session');
});
