<?php

use App\Http\Controllers\Api\Client\OrderController;
use App\Http\Controllers\Api\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'],function(){
    //client
    Route::group([],function(){
        Route::controller(App\Http\Controllers\Api\Client\AuthController::class)->group(function(){
            Route::post('/register','register');
            Route::post('/login','login');
            Route::post('/forgot-password','forgotPassword');
            Route::post('/reset-password','resetPassword');
        });
        Route::controller(App\Http\Controllers\Api\Client\MainController::class)->group(function(){
            Route::get('/restaurants','allRestaurants');
            Route::get('/restaurants/show','singleRestaurant');
            Route::get('/meals/show','singleMeal');
            Route::get('/offers','allOffers');
        });
    
        Route::group(['middleware' => 'auth:sanctum'],function(){
            Route::controller(App\Http\Controllers\Api\Client\MainController::class)->group(function(){
                Route::post('/comments/add','addComment');
                Route::get('/notifications','allNotifications');
            });
            Route::controller(App\Http\Controllers\Api\Client\OrderController::class)->group(function(){
                Route::get('/past-orders','pastOrders');
                Route::get('/current-orders','currentOrders');
                Route::post('/new-order','newOrder');
                Route::post('/receive-order','receiveOrder');
                Route::post('/decline-order','declineOrder');
            });
            Route::controller(App\Http\Controllers\Api\Client\AuthController::class)->group(function(){
                Route::post('/profile','profile');
                Route::post('/register-device-token','registerToken');
                Route::post('/remove-device-token','removeToken');
                Route::post('/logout','logout');
            });
        });
    });
    

    
    //restaurant
    Route::group(['prefix' => 'restaurant'],function(){
        Route::controller(App\Http\Controllers\Api\Restaurant\AuthController::class)->group(function(){
            Route::post('/register','register');
            Route::post('/login','login');
            Route::post('/forgot-password','forgotPassword');
            Route::post('/reset-password','resetPassword');
        });
        Route::group(['middleware' => 'auth:sanctum'],function(){
            Route::controller(App\Http\Controllers\Api\Restaurant\AuthController::class)->group(function(){
                Route::post('/profile','profile');
                Route::post('/register-device-token','registerToken');
                Route::post('/remove-device-token','removeToken');
                Route::post('/logout','logout');
            });
            Route::controller(App\Http\Controllers\Api\Restaurant\MealController::class)->group(function(){
                Route::get('/meals','allMeals');
                Route::post('/meals/add','addMeal');
                Route::post('/meals/edit','editMeal');
                Route::post('/meals/delete','deleteMeal');
            });
            Route::controller(App\Http\Controllers\Api\Restaurant\OfferController::class)->group(function(){
                Route::get('/offers','allOffers');
                Route::post('/offers/add','addOffer');
                Route::post('/offers/edit','editOffer');
                Route::post('/offers/delete','deleteOffer');
            });
            Route::controller(App\Http\Controllers\Api\Restaurant\OrderController::class)->group(function(){
                Route::get('/new-orders','newOrders');
                Route::post('/accept-order','acceptOrder');
                Route::post('/reject-order','rejectOrder');
                Route::get('/current-orders','currentOrders');
                Route::get('/past-orders','pastOrders');
            });
            Route::controller(App\Http\Controllers\Api\Restaurant\MainController::class)->group(function(){
                Route::get('/comments','comments');
            });
        });
    });






    //general
    Route::controller(App\Http\Controllers\Api\Client\GeneralController::class)->group(function(){
        Route::get('/settings','settings');
        Route::post('/contact-us','contact');
        Route::get('/categories','categories');
        Route::get('/cities','cities');
        Route::get('/neighborhoods','neighborhoods');
    });
    
});