<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EventPackageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuperAdminController;
use App\Models\Badge;
use App\Models\User;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/package', [HomeController::class, 'package']);
Route::get('/package/{eventPackage}', [HomeController::class, 'detailPackage']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');



Route::group(['middleware' => ['auth','ceklevel:user,admin,super-admin']], function () {
    Route::get('/user/setting', [ProfileController::class, 'index'])->name('profile.show');
    Route::put('/user/setting/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('/order', OrderUserController::class);

});
Route::group(['middleware' => ['auth','ceklevel:admin,super-admin']], function () {
    
    Route::get('admin/badge', function () {
        // $user = User::find(1); 
        $user = User::with('badges')->find(1);   
        // $badges = Badge::with('users')->get();
        $badges = Badge::withCount('users')->get();
        // dd($badges);
        return view('admin.badge.badge', compact('badges'));
    });
    Route::resource('admin/event-package', EventPackageController::class);
    Route::resource('admin/orders', OrderController::class);
    Route::resource('admin/user/customer', CustomerController::class);
    Route::resource('admin/user/admin', AdminController::class);
    Route::resource('admin/user/super-admin', SuperAdminController::class);
});
Route::group(['middleware' => ['auth','ceklevel:super-admin']], function () {
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index']);
    Route::resource('admin/user/super-admin', SuperAdminController::class);
});
