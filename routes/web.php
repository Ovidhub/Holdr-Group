<?php

use App\Http\Controllers\Admin\ClearCacheController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Settings;
use Laravel\Fortify\Http\Controllers\NewPasswordController;

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

require __DIR__ . '/home.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';
require __DIR__ . '/botman.php';

//activate and deactivate Online Trader
Route::any('/activate', function () {
	return view('activate.index', [
		'settings' => Settings::where('id', '1')->first(),
	]);
});

Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
});

Route::get('register-license', [ClearCacheController::class, 'saveLicense']);

Route::any('/revoke', function () {
	return view('revoke.index');
});

Route::post('/reset-password', [NewPasswordController::class, 'store'])
	->middleware(['guest:' . config('fortify.guard')])
	->name('password.update');

Route::get('/profile-photo/{filename}', [ProfileController::class, 'serveProfilePhoto'])
	->where('filename', '.*')
	->name('profile.photo');

Route::get('/storage/app/public/{path}', [ProfileController::class, 'servePublicStorage'])
	->where('path', '.*');

Route::get('/storage/{path}', [ProfileController::class, 'servePublicStorage'])
	->where('path', '.*');