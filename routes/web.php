<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\admin\CatController as AdminCatController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    // Route::resource('admins',AdminController::class);
    Route::resource('users',UserController::class);
    Route::resource('cats',CatController::class);
    Route::resource('roles',RoleController::class);
});


Route::prefix('dashboard')->middleware(['lang', 'auth'])->group(function() {
    Route::get('/', [AdminHomeController::class, 'index'])->name("dashboard");
    Route::get('/cats', [AdminCatController::class, 'index'])->name("cats");
    Route::post('/cats/store', [AdminCatController::class, 'store']);
    Route::post('/cats/update', [AdminCatController::class, 'update']);
    Route::get ('/cats/delete/{cat}', [AdminCatController::class, 'delete']);
    Route::get('/dashboard/login', [LoginController::class, 'showLoginForm'])->name('adminLogin')->middleware('guest');
    Route::post('/dashboard', [AdminHomeController::class, 'login'])->name('adminLogin');
    Route::get('/cats/toggle/{cat}', [AdminCatController::class, 'toggle']);
});

Route::get('/lang/set/{lang}', [LangController::class, 'set']); 

// Upload Image

// Route::post('/uploadfiletostorage',[App\Http\Controllers\UploadController::class, 'store']);




