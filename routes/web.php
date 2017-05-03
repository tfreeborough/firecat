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
    return view('pages.welcome');
})->name('home');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('verify', 'Auth\VerifyController@showVerify')->name('verify');
Route::get('verify/resend', 'Auth\VerifyController@showResend')->name('resend-verification');
Route::post('verify/resend', 'Auth\VerifyController@resend');
Route::get('verify/{token}', 'Auth\VerifyController@verify');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth','auth.partner','auth.verified'], 'prefix' => 'partner'], function () {
    Route::get('/', 'Partner\PartnerController@showHome');
});

Route::group(['middleware' => ['auth','auth.vendor','auth.verified'], 'prefix' => 'vendor'], function () {
    Route::get('/', 'Vendor\VendorController@showHome');
});