<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
    return view('app');
});

Auth::routes(['verify' => true]);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/newClient', 'HomeController@registrarCliente')->name('newClient');
Route::post('/updateClient', 'HomeController@updateCliente')->name('updateClient');
Route::post('/deleteClient', 'HomeController@deleteCliente')->name('deleteClient');

Route::get('getCountry', 'GeoCountryController@list')->name('Country.list');
Route::get('getProvince', 'GeoProvinceController@list')->name('Province.list');
Route::get('getActivity', 'TypeActivityController@list')->name('getActivity.list');


Route::get('getClientlist', 'ClientController@list')->name('cliente.list');
Route::get('getClientshow/{id}', 'ClientController@show')->name('cliente.show');
Route::get('getUserinfo', 'APIController@getUserinfo')->name('API.Userinfo');