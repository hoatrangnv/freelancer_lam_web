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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/api/tinh','UserController@showTinh')->name('api.tinh');

Route::group(['middleware' => 'auth'], function () {
    //show user profile
    Route::get('user/profile','UserController@showHistoryAddCard')->name('user.profle');;
    
    //Route nap the cao
    Route::get('/nap-the','NaptheController@index')->name('nap-the');
    Route::get('/nap-the/history','NaptheController@Historycard')->name('nap-the.Historycard');
    Route::get('/history-pending','NaptheController@HistoryPending')->name('nap-the.history-card');
    Route::post('/nap-card','NaptheController@napthecao')->name('nap-card');
    Route::get('/delete-card','NaptheController@deleteCard')->name('delete-card');

     //chuyen tien
    Route::get('/chuyen-tien','ChuyenTienController@index')->name('chuyen-tien.index');
    Route::post('/chuyen-tien','ChuyenTienController@chuyenTien')->name('chuyen-tien');
    Route::get('/history-chuyen-tien','ChuyenTienController@logHistory')->name('api.history-chuyen-tien');

    //RUT TIEN
    Route::get('/rut-tien','RuttienController@index')->name('rut-tien');
    Route::get('/api/bank','RuttienController@bankList')->name('api.bank');
    Route::get('/api/add-bank','RuttienController@addAccount')->name('api.add-bank');
    Route::get('/api/get-bank','RuttienController@getBank')->name('api.get-bank');
    Route::post('/withdraw','RuttienController@withDraw')->name('withdraw');
    Route::get('/history-rut-tien','RuttienController@historyRutTien')->name('rut-tien.history');

    //NAP TIEN
    Route::get('/nap-tien','NaptienController@index')->name('nap-tien.index');
    Route::get('/nap-tien/pock-up','NaptienController@pockup')->name('nap-tien.pockup');
    Route::get('/nap-tien/confirm','NaptienController@confirm')->name('nap-tien.confirm');
    Route::post('/nap-tien','NaptienController@NapTien')->name('nap-tien.nap');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/danh-sach-the-cao', 'AdminController@listCard')->name('admin.danh-sach-the-cao');
    Route::get('/admin/danh-sach-rut-tien', 'AdminController@listWithDraw')->name('admin.danh-sach-rut-tien');
    Route::post('/admin/addcard', 'AdminController@addCard')->name('admin.addcard');

   // rut tien
   Route::post('/admin/withdraw', 'AdminController@withDraw')->name('admin.withDraw');
   

   //nap tien
    Route::get('/admin/nap-tien','AdminController@listNapTien')->name('admin.nap-tien');
    Route::post('/admin/nap-tien/xac-nhan','AdminController@confirmAddMoney')->name('admin.xac-nhan-nap');

});
 