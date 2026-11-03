<?php

use App\Http\Controllers\AutoTaskController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

if (version_compare(PHP_VERSION, '7.1.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

//cron url
Route::get('/cron', [AutoTaskController::class, 'autotopup'])->name('cron');
//Front Pages Route
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('terms', [HomePageController::class, 'terms'])->name('terms');
Route::get('terms-of-service', [HomePageController::class, 'terms']);
Route::get('privacy', [HomePageController::class, 'privacy'])->name('privacy');
Route::get('privacy-policy', [HomePageController::class, 'privacy']);
Route::get('faq', [HomePageController::class, 'faq'])->name('faq');
Route::get('about', [HomePageController::class, 'about'])->name('about');
Route::get('contact', [HomePageController::class, 'contact'])->name('contact');
Route::get('business', [HomePageController::class, 'business'])->name('business');
Route::get('app', [HomePageController::class, 'app'])->name('app');
Route::get('apps', [HomePageController::class, 'app']);
Route::get('loans', [HomePageController::class, 'loans'])->name('loans');
Route::get('send-money', [HomePageController::class, 'loans']);
Route::get('cards', [HomePageController::class, 'cards'])->name('cards');
Route::get('personal', [HomePageController::class, 'personal'])->name('personal');
Route::get('chart', [HomePageController::class, 'personal']);
Route::get('verify', [HomePageController::class, 'verify']);
Route::post('homesendcontact', [HomePageController::class, 'homesendcontact'])->name('homesendcontact');
Route::post('codeverify', [HomePageController::class, 'codeverify'])->name('codeverify');
Route::get('alerts', [HomePageController::class, 'business']);
