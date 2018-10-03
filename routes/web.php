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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('user/profile', function () {
        return view('user.profile');
    })->name('user.profle');
    // Route admin
  
    
    //Route nap the cao
    Route::get('/nap-the','NaptheController@index')->name('nap-the');
    Route::post('/nap-card','NaptheController@napthecao')->name('nap-card');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/danh-sach-the-cao', 'AdminController@listCard')->name('admin.danh-sach-the-cao');
});
