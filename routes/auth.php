<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('frontend.index');
// });


Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'verified']], function(){
    Route::get('',[ HomeController::class, 'index'])->name('dashboard-page');
    Route::put('/profile_update/{id}', [HomeController::class, 'update_profile'])->name('update-profile-page');
    Route::put('change-password', [HomeController::class, 'validatepassword'])->name('change-password-page');
    Route::delete('destory/{id}', [HomeController::class, 'destory'])->name('delete-user');


    Route::get('optimize',function (){
        \Illuminate\Support\Facades\Artisan::call('optimize');
        return 1;
    });
    Route::get('clear',function (){
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        return 1;
    });
})->middleware(['auth', 'verified']);

