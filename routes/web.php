<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Views\Admin\DashboardViewController;
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


Route::view('/','livewire.public.home');
Route::view('/login','livewire.public.home');
Route::get('/sign-out',function (){
    Auth::logout();
    return redirect('/');
});

Route::get('uploads/{prefix}/{file}', function ($prefix, $file){
    if(!file_exists(storage_path() . "/app/" . $prefix . "/" . $file)) abort(404);
    return response()->file(storage_path() . "/app/" . $prefix . "/" . $file);
});

// Route::get('auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);


Route::middleware(['web', 'authenticator'])->prefix('admin')->group(function (){
    Route::get('/{page?}/{id?}', DashboardViewController::class);
});

