<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('smtpSettings', App\Http\Controllers\SmtpSettingController::class);
    Route::get('activate-smtp/{id}', [App\Http\Controllers\SmtpSettingController::class, 'activate'])->name('smtpSettings.activate');
    Route::resource('emails', App\Http\Controllers\EmailController::class);
    Route::resource('contacts', App\Http\Controllers\ContactController::class);
});
