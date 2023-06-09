<?php

// use App\Http\Controllers\customer\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\DashboardController;
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



Route::group(['prefix' => 'admin', 'as'=>'admin.'], function () {
    Route::get('/', [HomeController::class, 'login'])->name('new_login');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Auth::routes();
    // ___________________________ Admin Route ____________________________
    Route::group(['middleware' => ['auth', 'is_Admin']], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // manage-employees
        Route::get('manage-employees', [UserController::class, 'index']);
        Route::get('/delete-employee/{id}', [UserController::class, 'delete_employee']);
        Route::get('/add-employee', [UserController::class, 'add_employee']);
        Route::get('/edit-employee/{id}', [UserController::class, 'edit_employee']);
        Route::put('/insert-employee', [UserController::class, 'insert_employee']);
    });
});

Route::group(['as'=>'customer.', 'namespace' => 'App\Http\Controllers\customer\Auth', ], function () {
    Route::get('login', 'LoginController@loginForm')->name('loginForm');
    Route::get('register', 'LoginController@registerForm')->name('registerForm');
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('register', 'LoginController@register')->name('register');
    Route::get('social-login/{provider}', 'SocialController@redirect');
    Route::get('login/{provider}/callback','SocialController@Callback');

    Route::group(['middleware' => 'customerCheck'], function () {
        Route::get('dashboard', function() {
            return Auth::user();
        });
    });
});
