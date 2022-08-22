<?php

use App\Http\Controllers\Api\Auth\AuthLoginApiController;
use App\Http\Controllers\Api\Auth\AuthLogoutApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HotelApiController; 

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) 
    {
        return $request->user();
    }
);

Route::prefix('auth')->group(
    function () 
    {
        Route::post('login',  AuthLoginApiController::class )->name('auth.login'); 

        Route::group(
            [
                'middleware' => 'auth:sanctum', 
            ],
            function () 
            {
                Route::post('logout',  AuthLogoutApiController::class )->name('auth.logout');
            }
        );
    }
);

Route::prefix('hotels')->middleware('auth:sanctum')->group( 
    function() 
    {
        Route::get('',                  [ HotelApiController::class, 'index'   ])->name('hotels');
        Route::post('create',           [ HotelApiController::class, 'store'   ])->name('hotels.store');
        Route::get('{slug}/show',       [ HotelApiController::class, 'read'    ])->name('hotels.read');
        Route::put('{slug}/update',     [ HotelApiController::class, 'update'  ])->name('hotels.update');
        Route::delete('{slug}/destroy', [ HotelApiController::class, 'destroy' ])->name('hotels.destroy');
    }
);