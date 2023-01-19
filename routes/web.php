<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\NeighborhoodController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RestaurantController;
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

Route::group(['prefix' => 'admin'],function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('/login','login')->name('login');
        Route::post('/authenticate','authenticate')->name('authenticate');
        Route::get('/forgot-password','forgotPassword')->name('forgot_password');
        Route::post('/request-password','requestPassword')->name('request_password');
        Route::get('/reset-password','resetPasswordView')->name('reset_password_view');
        Route::post('/reset-password','resetPassword')->name('reset_password');
    });
    

    Route::group(['middleware' => 'auth'],function(){
        Route::get('/', function () {
            return view('admin/dashboard');
        })->name('admin.home');
        //Cities Module
        Route::resource('cities',CityController::class);
        Route::resource('categories',CategoryController::class);
        Route::resource('neighborhoods',NeighborhoodController::class);
        Route::resource('restaurants',RestaurantController::class)->only(['index','show','destroy']);

        Route::resource('offers',OfferController::class)->only(['index','destroy']);
        Route::resource('contact-messages',ContactMessageController::class)->only(['index','destroy']);
        Route::resource('payments',PaymentController::class)->only(['index','create','edit','destroy']);
        
        Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    });
});

