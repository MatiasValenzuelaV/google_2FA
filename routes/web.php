<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PersonalidadController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index2'])->name('home2');

Route::get('/complete-registration', [RegisterController::class, 'completeRegistration'])->name('complete-registration');

Route::post('/2fa', function () {
    return view('/home');
})->name('2fa')->middleware('2fa');

Route::get('test', fn () => phpinfo());


Route::post('/login-two-factor/{user}', [LoginController::class, 'login2FA'])->name('login.2fa');


Route::resource('tipos', TipoController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('personalidad', PersonalidadController::class);
