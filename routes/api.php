<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishListController;
use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("app")->middleware('web')->group(function (){
    // Route::get('auth/{provider}', [AuthController::class, 'redirectToProvider']);
    // Route::get('auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);
});

Route::prefix("app")->middleware('api')->group(function (){

    Route::post('login', [UserController::class, 'apiAuthTaken'])->name("api_login_alt");

    Route::post('google-account', [UserController::class, 'authWithGoogle'])->name("google_login");

    Route::get('auth/{provider}', [AuthController::class, 'redirectToProvider']);
    Route::get('auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);


    Route::post('email-check', [UserController::class, 'emailCheck']);
    Route::post('code-check', [UserController::class, 'codeCheck']);
    // resend code
    Route::post('resend-code', [UserController::class, 'resendCode']);
    Route::post('password-reset', [UserController::class, 'passwordReset']);

    Route::post('create-account', [UserController::class, 'apiRegistration']);

    Route::get('countries-codes', [UserController::class, 'countriesCodes']);

    Route::middleware('auth:api')->group(function (){
        Route::get('profile', [UserController::class, 'profile']);
        // update profile
        Route::post('update-profile', [UserController::class, 'updateProfile']);
        Route::apiResource('wishlist', WishListController::class); 
        Route::post('product-rate', [ProductController::class, 'addRate']);
    });

    Route::get('products', [ProductController::class, 'apiList']);
    Route::get('best-seller', [ProductController::class, 'apiListBestSeller']);
    Route::get('product/{id}', [ProductController::class, 'apiGet']);

    

    Route::post('contact-us', [ContactUsController::class, 'store']);

    Route::get('opinion', [OpinionController::class, 'index']);

    Route::get('categories', [CategoryController::class, 'apiList']);
    Route::get('category/{id}', [CategoryController::class, 'apiGet']);

    
    Route::apiResource('subscription', SubscriptionController::class);

    Route::get('home-categories', [CategoryController::class, 'apiHomeList']);

    // get settings
    Route::get('settings', [SettingsController::class, 'index']);
});