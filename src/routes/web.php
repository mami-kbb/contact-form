<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', [ContactController::class,'index']);
Route::get('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'index']);
});
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'search'])->name('admin');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/search', [App\Http\Controllers\AdminController::class, 'search'])->name('admin');
});
Route::get('/contacts/export', [ContactController::class, 'export'])->name('contacts.export');
Route::delete('/admin/delete', [AdminController::class, 'destroy']);